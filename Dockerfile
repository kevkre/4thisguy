FROM alpine:3
LABEL maintainer="André Flemming <daslampe@lano-crew.org>"

RUN apk add --no-cache lftp
