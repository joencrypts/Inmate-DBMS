// This is a PHP application, not a Node.js application
console.log('This is a PHP application. Please use the PHP configuration.');

// Create a simple HTTP server to bind to a port
const http = require('http');
const { exec } = require('child_process');
const port = process.env.PORT || 10000;

// Check if PHP is available
exec('php -v', (error) => {
  if (error) {
    console.error('PHP is not available:', error);
    console.log('Starting Node.js fallback server...');
    
    // Start the Node.js fallback server
    const server = http.createServer((req, res) => {
      res.writeHead(200, { 'Content-Type': 'text/plain' });
      res.end('This is a PHP application. PHP is not available on this server. Please contact support.');
    });
    
    server.listen(port, '0.0.0.0', () => {
      console.log(`Node.js fallback server running on port ${port}`);
    });
  } else {
    console.log('PHP is available, but the PHP server is not running.');
    console.log('Starting Node.js fallback server...');
    
    // Start the Node.js fallback server
    const server = http.createServer((req, res) => {
      res.writeHead(200, { 'Content-Type': 'text/plain' });
      res.end('This is a PHP application. The PHP server is not running. Please contact support.');
    });
    
    server.listen(port, '0.0.0.0', () => {
      console.log(`Node.js fallback server running on port ${port}`);
    });
  }
}); 