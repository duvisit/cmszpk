#=============================================================================
OPIS = Sustav za upravljanje sadržajem
NAZIV = cmszpk
VERZIJA = 1.0.0
MAK = Makefile
DEP = $(MAK).dep

PHP = php

GITURL = https://github.com/perob/cmszpk

#---------- makefile postavke ----------------------------

SHELL = /bin/sh

.SUFFIXES:
.SUFFIXES: .php

#---------- pomoćni programi -----------------------------

RM  = rm -f
CAT = cat
TOUCH = touch

#---------- programski kod -------------------------------

#---------------------------------------------------------

#---------- ciljevi --------------------------------------

.PHONY: all help development production

all: help

help:
	@echo "$(OPIS) - $(NAZIV) $(VERZIJA)"
	@echo "Korištenje:"
	@echo "    make             - prikaži pomoć"
	@echo "    make development - postavi git granu za razvoj"
	@echo "    make production  - postavi git granu za proizvodnju"
	@echo "    make update      - azuriraj izvorni kod"

development:
	git checkout -b razvoj

production:
	git checkout -b proizvodnja

