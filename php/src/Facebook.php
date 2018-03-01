<?php
namespace Sustav\Model;

use Sustav\Postavke;
use Sustav\Model\Model;

/**
 * Facebook Graph API.
 */
class Facebook
{
    private static function fb_message ( $message ) {

        $msg = '';
        $array = preg_split( "/\r\n|\n|\r/", $message );
        foreach ( $array as $value ) {
            if ( !empty( $value )) {
                $msg .= '<p>' . $value . '</p>';
            }
        }
        return $msg;
    }

    private static function fb_cache () {

        $postavke = new Postavke();
        $database = $postavke->database();
        $page_id = $postavke->facebookPageId();
        $app_id = $postavke->facebookAppId();
        $app_secret = $postavke->facebookAppSecret();
        $api_version = $postavke->facebookApiVersion();

        $conn = Model::dbConnect( $database );
        $data = Model::sqlFetchAll( $conn, "SELECT * FROM fbfeed ORDER BY id ASC LIMIT 9" );
        $conn = null;

        if ( empty( $page_id ) || empty( $app_id ) || empty( $app_secret ))
            return $data;

        if ( !empty( $data ) && $data !== false ) {
            $timestamp = intval( $data[0]['stamp'] );
            if (( time() - $timestamp ) < ( 4 * 60 * 60 ))
                return $data;
        }

        $response = file_get_contents(
            "https://graph.facebook.com/oauth/access_token?client_id={$app_id}&client_secret={$app_secret}&grant_type=client_credentials"
        );
        if ( $response === false )
            return $data;

        $json_token = json_decode( $response, true );
        $access_token = empty( $json_token['access_token'] ) ? false : $json_token['access_token'];
        if ( $access_token === false )
            return $data;

        $fields = 'id,type,message,picture,link,name,caption,created_time,object_id';
        $json_data = file_get_contents(
            "https://graph.facebook.com/{$api_version}/{$page_id}/feed?access_token={$access_token}&fields={$fields}&limit=9"
        );
        if ( $json_data === false )
            return $data;

        $fbfeed = json_decode( $json_data, true );
        //echo '<pre>', print_r( $fbfeed, true ), '</pre>';

        $id = 1;
        $stamp = time();
        $records = array(
            'id','type','message','picture','link','name','caption','created_time','object_id'
        );

        $conn = Model::dbConnect( $database );
        $conn->beginTransaction();

        foreach ( $fbfeed['data'] as $fbpost ) {
            $sqlcol = array();
            $params = array();

            $sqlcol[] = 'stamp';
            $params[':stamp'] = $stamp;

            foreach ( $records as $item ) {
                if ( isset( $fbpost[$item] )) {
                    $sqlcol[] = "fb_$item";
                    switch ( $item ) {
                    case 'message':
                        $params[":fb_$item"] = self::fb_message(
                            htmlspecialchars( $fbpost[$item], ENT_QUOTES | ENT_HTML5, 'UTF-8' )
                        );
                        break;
                    case 'name':
                    case 'caption':
                        $params[":fb_$item"] = htmlspecialchars(
                            $fbpost[$item], ENT_QUOTES | ENT_HTML5, 'UTF-8' );
                        break;
                    default:
                        $params[":fb_$item"] = $fbpost[$item];
                    }
                } else {
                    $sqlcol[] = "fb_$item";
                    $params[":fb_$item"] = "";
                }
            }
            $list = array();
            foreach ( $sqlcol as $key ) { $list[] = "$key=:$key"; }
            $colset = implode( ',', $list );

            $sql = "UPDATE fbfeed SET $colset WHERE id=$id";

            $st = $conn->prepare( $sql );
            $st->execute( $params );

            $id += 1;
        }
        $conn->commit();

        $data = Model::sqlFetchAll( $conn, "SELECT * FROM fbfeed ORDER BY id ASC LIMIT 9" );
        $conn = null;

        return $data;
    }

    public static function feed( $limit ) {

        $fbfeed = self::fb_cache();

        if ( $fbfeed === false ) {
            $date = iconv( 'ISO-8859-2', 'UTF-8', strftime( '%e. %B, %Y.', time() ));
            echo '<div class="uk-width-medium-1-3">', PHP_EOL;
            echo '<div class="uk-panel uk-panel-box uk-panel-box-secondary">', PHP_EOL;
            echo '<h3 class="uk-panel-title">Status</h3>', PHP_EOL;
            echo '<div class="uk-article-meta">', $date, '</div>', PHP_EOL;
            echo '<p>Facebook feed not available</p>', PHP_EOL;
            echo '</div>', PHP_EOL;
            echo '</div>', PHP_EOL;
        } else {

            $counter = ( $limit < 1 || $limit > 9 ) ? 3 : $limit;

            foreach ( $fbfeed as $fbpost ) {

                if ( in_array( $fbpost['fb_type'], array( 'status', 'link', 'photo', 'video', 'event', 'demo' ))) {

                    if ( $counter-- == 0 )
                        break;

                    // open list
                    echo '<div class="uk-width-medium-1-3">';
                    echo '<div class="uk-panel uk-panel-box uk-panel-box-secondary">';

                    // set date
                    $date = '';
                    if ( isset( $fbpost['fb_created_time'] ) ) {
                        $date = iconv( 'ISO-8859-2', 'UTF-8',
                            strftime( '%e. %B, %Y.', strtotime( $fbpost['fb_created_time'] )));
                    }

                    // check if post type is a status
                    if ( $fbpost['fb_type'] == 'status' ) {
                        if ( isset( $fbpost['fb_picture'] ) && !empty( $fbpost['fb_picture'] )) {
                            echo '<div class="uk-panel-teaser uk-cover-background"',
                                ' style="height:240px; background-image:url(\'', $fbpost['fb_picture'], '\');"></div>';
                        }
                        echo '<h3 class="uk-panel-title"><a class="uk-link" href="', $fbpost['fb_link'], '">Status</a></h3>';
                        echo '<div class="uk-article-meta">', $date, '</div>';
                        if ( !empty( $fbpost['fb_message'] ))
                            echo $fbpost['fb_message'];
                    }

                    // check if post type is a link
                    else if ( $fbpost['fb_type'] == 'link' ) {
                        if ( isset( $fbpost['fb_picture'] ) && !empty( $fbpost['fb_picture'] )) {
                            echo '<div class="uk-panel-teaser uk-cover-background"',
                                ' style="height:240px; background-image:url(\'', $fbpost['fb_picture'], '\');"></div>';
                        }
                        echo '<h3 class="uk-panel-title">Link</h3>';
                        echo '<div class="uk-article-meta">', $date, '</div>';
                        $fbpost_link = isset( $fbpost['fb_link'] ) ? $fbpost['fb_link'] : "#";
                        $fbpost_caption = isset( $fbpost['fb_caption'] ) ? $fbpost['fb_caption'] : "";
                        $fbpost_name = isset( $fbpost['fb_name'] ) ? $fbpost['fb_name'] : "Link";
                        echo '<p><a href="', $fbpost_link, '" title="', $fbpost_caption, '">', $fbpost_name, '</a></p>';
                        if ( !empty( $fbpost['fb_message'] ))
                            echo $fbpost['fb_message'];
                    }

                    // check if post type is a photo
                    else if ( $fbpost['fb_type'] == 'photo' ) {
                        // thumbnail, normal, album
                        $photo = 'https://graph.facebook.com/' . $fbpost['fb_object_id'] . '/picture?type=normal';
                        echo '<div class="uk-panel-teaser">';
                        echo '<img src="', $photo, '" alt="">';
                        echo '</div>';
                        echo '<h3 class="uk-panel-title"><a class="uk-link" href="', $fbpost['fb_link'], '">Photo</a></h3>';
                        echo '<div class="uk-article-meta">', $date, '</div>';
                        if ( !empty( $fbpost['fb_message'] ))
                            echo $fbpost['fb_message'];
                    }

                    // check if post type is a video
                    else if ( $fbpost['fb_type'] == 'video' ) {
                        if ( isset( $fbpost['fb_picture'] ) && !empty( $fbpost['fb_picture'] )) {
                            echo '<div class="uk-panel-teaser uk-cover-background"',
                                ' style="height:240px; background-image:url(\'', $fbpost['fb_picture'], '\');"></div>';
                        }
                        echo '<h3 class="uk-panel-title"><a class="uk-link" href="', $fbpost['fb_link'], '">Video</a></h3>';
                        echo '<div class="uk-article-meta">', $date, '</div>';
                        if ( !empty( $fbpost['fb_message'] ))
                            echo $fbpost['fb_message'];
                    }

                    // check if post type is a event
                    else if ( $fbpost['fb_type'] == 'event' ) {
                        if ( isset( $fbpost['fb_picture'] ) && !empty( $fbpost['fb_picture'] )) {
                            echo '<div class="uk-panel-teaser uk-cover-background"',
                                ' style="height:240px; background-image:url(\'', $fbpost['fb_picture'], '\');"></div>';
                        }
                        echo '<h3 class="uk-panel-title"><a class="uk-link" href="', $fbpost['fb_link'], '">Event</a></h3>';
                        echo '<div class="uk-article-meta">', $date, '</div>';
                        if ( !empty( $fbpost['fb_name'] )) {
                            if ( !empty( $fbpost['fb_link'] )) {
                                $fbpost_link = isset( $fbpost['fb_link'] ) ? $fbpost['fb_link'] : "#";
                                $fbpost_caption = isset( $fbpost['fb_caption'] ) ? $fbpost['fb_caption'] : "";
                                $fbpost_name = isset( $fbpost['fb_name'] ) ? $fbpost['fb_name'] : "Link";
                                echo '<p><a href="', $fbpost_link, '" title="', $fbpost_caption, '">', $fbpost_name, '</a></p>';
                            } else {
                                echo '<p>' . $fbpost['fb_name'] . '</p>';
                            }
                        }
                        if ( !empty( $fbpost['fb_message'] ))
                            echo $fbpost['fb_message'];
                    }

                    // check if post type is a demo
                    else if ( $fbpost['fb_type'] == 'demo' ) {
                        $photo = $fbpost['fb_picture'];
                        $date = iconv( 'ISO-8859-2', 'UTF-8', strftime( '%e. %B, %Y.', time() ));
                        echo '<div class="uk-panel-teaser">';
                        echo '<img src="', $photo, '" alt="">';
                        echo '</div>';
                        echo '<h3 class="uk-panel-title">Demo</h3>';
                        echo '<div class="uk-article-meta">', $date, '</div>';
                        if ( !empty( $fbpost['fb_message'] ))
                            echo $fbpost['fb_message'];
                    }

                    echo '</div>';
                    echo '</div>', PHP_EOL;
                }
            }
        }
    }
}
