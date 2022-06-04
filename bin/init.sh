#!/bin/bash
symfony console d:d:drop --force
symfony console d:d:create
symfony console d:m:m --no-interaction
symfony console d:s:drop --force --no-interaction
symfony console d:s:create
symfony console d:f:l --no-interaction
echo  "You have now a fresh database"