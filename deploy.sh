#!/bin/sh

#grunt build
bundle exec compass compile

git add -A
git commit -m "Deploying to server"
git push 


