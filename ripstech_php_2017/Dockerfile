# Bắt đầu từ image gốc mà bạn đang sử dụng
FROM vsplate/deb_apache2_php7_mysql5:latest

# Cài đặt Xdebug, sau đó ngay lập tức VÔ HIỆU HÓA nó và XÓA sạch các tệp cấu hình mặc định.
# Việc này để lại một "môi trường sạch", sẵn sàng nhận tệp cấu hình từ docker-compose.
RUN apt-get update && \
    apt-get install -y php-xdebug && \
    phpdismod -s all xdebug && \
    rm /etc/php/7.0/mods-available/xdebug.ini && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*