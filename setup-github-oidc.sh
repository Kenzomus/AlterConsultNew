#!/bin/bash
set -e

PROJECT_ID="alter-consult-464302"
POOL_NAME="github-pool"
PROVIDER_NAME="github"
SERVICE_ACCOUNT="155305720214-compute@developer.gserviceaccount.com"
GITHUB_REPO="Kenzomus/AlterConsultNew"
LOCATION="global"

echo "🔹 Step 1: Delete any existing OIDC provider (if exists)"
gcloud iam workload-identity-pools providers list \
  --project="$PROJECT_ID" \
  --location="$LOCATION" \
  --workload-identity-pool="$POOL_NAME" --format="value(name)" | grep -q "$PROVIDER_NAME" && \
    gcloud iam workload-identity-pools providers delete "$PROVIDER_NAME" \
      --project="$PROJECT_ID" \
      --location="$LOCATION" \
      --workload-identity-pool="$POOL_NAME" \
      --quiet || echo "No existing provider to delete."

echo "🔹 Step 2: Create OIDC provider for GitHub Actions"
gcloud iam workload-identity-pools providers create-oidc "$PROVIDER_NAME" \
  --project="$PROJECT_ID" \
  --location="$LOCATION" \
  --workload-identity-pool="$POOL_NAME" \
  --display-name="GitHub Provider" \
  --issuer-uri="https://token.actions.githubusercontent.com" \
  --attribute-mapping="google.subject=assertion.sub,attribute.repository=assertion.repository" \
  --attribute-condition="assertion.repository=='$GITHUB_REPO'"

echo "🔹 Step 3: Bind service account to the provider"
gcloud iam service-accounts add-iam-policy-binding "$SERVICE_ACCOUNT" \
  --project="$PROJECT_ID" \
  --role="roles/iam.workloadIdentityUser" \
  --member="principalSet://iam.googleapis.com/projects/155305720214/locations/global/workloadIdentityPools/$POOL_NAME/attribute.repository/$GITHUB_REPO"

echo "🔹 Step 4: Verify the provider exists and is active"
gcloud iam workload-identity-pools providers list \
  --project="$PROJECT_ID" \
  --location="$LOCATION" \
  --workload-identity-pool="$POOL_NAME"

echo "✅ All steps completed. GitHub Actions OIDC provider is ready."
