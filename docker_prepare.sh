#!/bin/bash

docker run --name dockercidb -d -p 15432:5432 -e POSTGRES_PASSWORD=dockerci -e POSTGRES_USER=dockerci -e POSTGRES_DB=dockerci postgres:9.6