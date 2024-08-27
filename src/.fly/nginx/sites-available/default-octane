server {
    listen 8080 default_server;
    listen [::]:8080 default_server;

    root /var/www/html/public;

    index index.html index.htm index.php;

    server_name _;

    charset utf-8;

    client_max_body_size 2048M;

    access_log /dev/stdout fly;

    location /index.php {
        try_files /not_exists @octane;
    }

    location / {
        try_files $uri $uri/ @octane;
    }

    location @octane {
        set $suffix "";

        if ($uri = /index.php) {
            set $suffix ?$query_string;
        }

        proxy_http_version 1.1;
        proxy_set_header Host $http_host;
        proxy_set_header Scheme $scheme;
        proxy_set_header SERVER_PORT $server_port;
        proxy_set_header REMOTE_ADDR $remote_addr;
        proxy_set_header X-Forwarded-For $http_fly_client_ip;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection $connection_upgrade;

        proxy_buffers 16 16k;
        proxy_buffer_size  32k;

        proxy_pass http://127.0.0.1:8000$suffix;
    }

    location = /favicon.ico {
        log_not_found off;
        access_log    off;
    }

    location = /robots.txt {
        log_not_found off;
        access_log    off;
    }

    location ~* \.(?:css(\.map)?|js(\.map)?|jpe?g|png|gif|ico|cur|heic|webp|tiff?|mp3|m4a|aac|ogg|midi?|wav|mp4|mov|webm|mpe?g|avi|ogv|flv|wmv)$ {
        expires    7d;
        access_log off;
        log_not_found off;
        # Pass to PHP to ensure PHP apps can handle routes that end in these filetypes
        try_files $uri @octane;
    }

    location ~* \.(?:svgz?|ttf|ttc|otf|eot|woff2?)$ {
        add_header Access-Control-Allow-Origin "*";
        expires    7d;
        access_log off;
    }

    location ~ /\.(?!well-known) {
        deny all;
    }

    add_header X-Frame-Options           "SAMEORIGIN" always;
    add_header X-Content-Type-Options    "nosniff" always;
    add_header Referrer-Policy           "no-referrer-when-downgrade" always;
}
