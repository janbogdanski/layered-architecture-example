server {
    listen  80;

    # this path MUST be exactly as docker-compose.fpm.volumes,
    # even if it doesn't exist in this dock.
    root /app/public;

    location / {
        try_files $uri /index.php$is_args$args;
    }

   location ~ \.php(/|$) {
        fastcgi_pass app:9000;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;
  }

  access_log /dev/stdout;
  access_log /dev/stderr;
}