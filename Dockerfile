FROM node:lts-alpine

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl

RUN apk add --update python3 make g++ && rm -rf /var/cache/apk/*
WORKDIR /usr/src/app
COPY package*.json ./
COPY . .
RUN npm install

EXPOSE 8080
