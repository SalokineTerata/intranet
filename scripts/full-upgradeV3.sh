#!/bin/bash
ENV=$1

cd /u1/DATA01/webldc/$ENV-intranet/v3/
./scripts/importDB-$ENV-V2toV3.sh
./apps/upgrade/upgrade2.0to3.0_$ENV.sh
