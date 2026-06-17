<?php

// Forward Vercel serverless requests into the native Laravel public bootstrap index
require __DIR__ . '/../public/index.php';

// Vercel is built to look for serverless functions inside an api/ directory at the root of a project.
//  Because Laravel's real entry point is inside public/index.php, this new file acts as a simple bridge. 
// When a user visits your Vercel URL, Vercel hits api/index.php, which immediately 
// passes the steering wheel over to Laravel's native public directory!