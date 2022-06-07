# Setup Project Laravel lần đầu tiên Clone

- chạy composer install, npm install để cài đặt các package từ bên thứ 3.
- copy .env từ .env.example và sửa để kết nối CSDL, URL, ...
- run php artisan key:generate để tạo key bảo mật mới.

# Các Example Laravel:

#### **-Branch: _`elasticsearch`_**
- Task elasticsearch and queue
#### **-Branch: _`webhook-endpoint-casso`_**
- Viết 1 webhook endpoint để xử lý sử kiện webhook xử lý thanh toán auto của ngân hàng,
sử dụng casso(developer.casso.vn)
#### **-Branch: _`bot-telegram`_**
- Viết service bắn bug về telegram khi có bug
#### **-Branch: _`laravel-permission`_**
- Viết phân quyền cho user bằng package laravel-permission
#### **-Branch: _`role-permission`_**
- Viết phân quyền cho user. tự viết
#### **-Branch: _`jwt-auth`_**
- Tạo token cho api khi đăng nhập vào amin.
