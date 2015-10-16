#!/bin/bash
SCRIPT_DIR=`dirname $0`
GIT_DIR="/u1/DATA01/webldc/dev-intranet/v3"

cd $GIT_DIR

$SCRIPT_DIR/git-config.sh

git push http://github.com/SalokineTerata/intranet.git
