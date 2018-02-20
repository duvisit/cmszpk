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
	@if git show-ref --quiet refs/heads/razvoj; then \
		git checkout razvoj; \
	else \
		git checkout -b razvoj; \
		(cd php && make database); \
	fi
	(cd php && make test)

production:
	@if git show-ref --quiet refs/heads/proizvodnja; then \
		git checkout proizvodnja; \
	else \
		git checkout -b proizvodnja; \
		(cd php && make database); \
	fi
	(cd php && make test)

