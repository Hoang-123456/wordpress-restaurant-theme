#!/usr/bin/env bash
# Builds a clean, upload-ready theme ZIP via `git archive`.
# Dev-only files are excluded via .gitattributes (export-ignore).
set -euo pipefail

cd "$(git rev-parse --show-toplevel)"

SLUG="restaurant-theme"
OUT_DIR="dist"
OUT_FILE="${OUT_DIR}/${SLUG}.zip"

if [ -n "$(git status --porcelain)" ]; then
  echo "Warning: uncommitted changes detected." >&2
  echo "git archive only packages the last commit (HEAD) - uncommitted changes will NOT be included." >&2
fi

mkdir -p "$OUT_DIR"
git archive --format=zip --prefix="${SLUG}/" --output="$OUT_FILE" HEAD

echo "Built ${OUT_FILE}"
