#!/bin/bash

bower="bower_components/social-junk"
files=( "social-junk.js" "social-junk.min.js" )

for file in "${files[@]}"
do
	cp -rf "$bower/$file" js
	echo "new SocialJunk();" >> "js/$file"
done