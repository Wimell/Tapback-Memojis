server {
    listen 8080 default_server;
    listen [::]:8080 default_server;

    root /var/www/html/public;

    index index.html index.htm index.php;

    server_name _;

    charset utf-8;

    client_max_body_size 2048M;

    access_log /dev/stdout fly;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_param HTTP_X_FORWARDED_FOR $http_fly_client_ip;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_buffers  16 16k;
        fastcgi_buffer_size  32k;
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
        try_files $uri /index.php?$query_string;
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
