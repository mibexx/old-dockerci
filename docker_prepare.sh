#!/bin/bash

docker run --name dockercidb -d -p 15432:5432 -e POSTGRES_PASSWORD=dockerci -e POSTGRES_USER=dockerci -e POSTGRES_DB=dockerci postgres:9.6
docker run --name dockercirmq -d -p 5672:5672 -p 15672:15672 rabbitmq:3-management
docker run --name dockercirredis -d -p 6379:6379 redis