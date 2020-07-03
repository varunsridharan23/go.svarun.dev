#!/bin/sh
set -eu

echo "🔄 Fetching Envato Links"
php .github/generator-app/envato.php

echo "🔄 Fetching WordPress Links"
php .github/generator-app/wordpress.php

echo "🔄 Running Shortlink Generator
"
php .github/generator-app/app.php

git config --global user.email "githubactionbot@gmail.com" && git config --global user.name "Github Action Bot"
cd ../
PUSH_TO_BRANCH="gh-pages"

if [ -z "$(git ls-remote --heads https://x-access-token:${GITHUB_TOKEN}@github.com/${GITHUB_REPOSITORY}.git ${PUSH_TO_BRANCH})" ]; then
  echo " "
  echo "##[group] $PUSH_TO_BRANCH Create Log"
  git clone --quiet https://x-access-token:$GITHUB_TOKEN@github.com/${GITHUB_REPOSITORY}.git $PUSH_TO_BRANCH >/dev/null
  cd $PUSH_TO_BRANCH
  git checkout --orphan $PUSH_TO_BRANCH >/dev/null
  git rm -rf . >/dev/null
  echo "$GITHUB_REPOSITORY" >README.md
  git add README.md
  git commit -a -m "➕ Create $PUSH_TO_BRANCH Branch"
  git push origin $PUSH_TO_BRANCH
  cd ..
  echo "##[endgroup]"
  echo "🗃 $PUSH_TO_BRANCH Created"
  echo " "
else
  echo "##[group] 👌 $PUSH_TO_BRANCH Cloned"
  git clone --quiet --branch=$PUSH_TO_BRANCH https://x-access-token:$GITHUB_TOKEN@github.com/${GITHUB_REPOSITORY}.git $PUSH_TO_BRANCH
  echo "##[endgroup]"
fi

cp $PUSH_TO_BRANCH/CNAME /
rm -rf $PUSH_TO_BRANCH/*
cp -r $GITHUB_WORKSPACE/output_html/* $PUSH_TO_BRANCH/
cd $PUSH_TO_BRANCH/
cp /CNAME /$PUSH_TO_BRANCH

if [ "$(git status --porcelain)" != "" ]; then
  echo "##[group] 👌 Website Published"
  git add .
  git commit -m " :book:  #$GITHUB_RUN_NUMBER - Website Regenerated /  :zap:  Triggered By $GITHUB_SHA"
  git push origin $PUSH_TO_BRANCH
  echo "##[endgroup]"
else
  echo "✅ Nothing To Push"
fi
