const { exec } = require('child_process');
const http = require('http');
const path = require('path');
const fs = require('fs');

const PORT = process.env.PORT || 10000;
const NODE_ENV = process.env.NODE_ENV || 'development';

// Configure logging
const log = (message, type = 'info') => {
  const timestamp = new Date().toISOString();
  console.log(`[${timestamp}] [${type.toUpperCase()}] ${message}`);
};

// Function to check if PHP is available
function checkPHP(callback) {
  exec('php -v', (error, stdout, stderr) => {
    if (error) {
      log(`PHP is not available: ${error}`, 'error');
      callback(false);
    } else {
      log(`PHP is available: ${stdout}`, 'info');
      callback(true);
    }
  });
}

// Function to start PHP server
function startPHPServer() {
  log('Starting PHP server...', 'info');
  
  // Set PHP environment variables
  const phpEnv = {
    ...process.env,
    PHP_CLI_SERVER_WORKERS: 4,
    PHP_CLI_SERVER_READ_TIMEOUT: 60,
    PHP_DISPLAY_ERRORS: process.env.PHP_DISPLAY_ERRORS || '0',
    PHP_ERROR_REPORTING: process.env.PHP_ERROR_REPORTING || 'E_ALL & ~E_DEPRECATED & ~E_STRICT'
  };

  const phpProcess = exec(`php -S 0.0.0.0:${PORT} -t . router.php`, { env: phpEnv });
  
  phpProcess.stdout.on('data', (data) => {
    log(`PHP Server: ${data}`, 'info');
  });
  
  phpProcess.stderr.on('data', (data) => {
    log(`PHP Server Error: ${data}`, 'error');
  });
  
  phpProcess.on('close', (code) => {
    log(`PHP Server process exited with code ${code}`, 'error');
    if (code !== 0) {
      startFallbackServer();
    }
  });

  // Handle process termination
  process.on('SIGTERM', () => {
    log('Received SIGTERM signal. Shutting down PHP server...', 'info');
    phpProcess.kill('SIGTERM');
  });

  process.on('SIGINT', () => {
    log('Received SIGINT signal. Shutting down PHP server...', 'info');
    phpProcess.kill('SIGINT');
  });
}

// Function to start fallback server
function startFallbackServer() {
  log('Starting fallback server...', 'warn');
  const server = http.createServer((req, res) => {
    res.writeHead(200, { 'Content-Type': 'text/html' });
    res.end(`
      <html>
        <head>
          <title>Service Unavailable</title>
          <style>
            body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
            h1 { color: #e74c3c; }
            p { color: #7f8c8d; }
          </style>
        </head>
        <body>
          <h1>Service Temporarily Unavailable</h1>
          <p>The PHP server is not running. Please try again later or contact support.</p>
        </body>
      </html>
    `);
  });
  
  server.listen(PORT, '0.0.0.0', () => {
    log(`Fallback server running on port ${PORT}`, 'warn');
  });

  // Handle process termination for fallback server
  process.on('SIGTERM', () => {
    log('Received SIGTERM signal. Shutting down fallback server...', 'info');
    server.close(() => {
      process.exit(0);
    });
  });

  process.on('SIGINT', () => {
    log('Received SIGINT signal. Shutting down fallback server...', 'info');
    server.close(() => {
      process.exit(0);
    });
  });
}

// Log startup information
log(`Starting application in ${NODE_ENV} mode`, 'info');
log(`Server will listen on port ${PORT}`, 'info');

// Check if PHP is available and start the appropriate server
checkPHP((phpAvailable) => {
  if (phpAvailable) {
    startPHPServer();
  } else {
    startFallbackServer();
  }
}); 