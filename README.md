# Demo Cookie & Session

## Yêu cầu

- PHP 8.x
- `make`

## Cách chạy

Chạy lệnh sau tại thư mục gốc của dự án:

```bash
make run
```

Sau đó mở trình duyệt tại:

```text
http://localhost:8002
```

## Xem cookie ở đâu, session ở đâu.
- Cookie nằm trên browser, em có thể mở DevTools để xem trực tiếp ở Application vào mục Cookie.
- Session nằm trên server, browser chỉ giữ session id.
- Session có thể lưu ở 3 chỗ: file (/var/lib/php/sessions), database và redis

## Sơ đồ hoạt động của cookie/session

```mermaid
sequenceDiagram
    participant B as Browser
    participant S as PHP Server
    participant SS as Session Storage

    alt Browser chưa có cookie
        B->>S: Truy cập index.php<br/>không có PHPSESSID
    else Browser đã có cookie
        B->>S: Truy cập index.php<br/>tự động kèm PHPSESSID
    end

    Note over S: index.php không gọi session_start()<br/>nên không sử dụng session
    S-->>B: Hiển thị trang công khai
    Note over B: Người dùng bấm "Đăng nhập"

    B->>S: Truy cập login.php
    S->>SS: session_start(): mở hoặc tạo session

    alt Đã có user trong session
        SS-->>S: Trả thông tin user
        S-->>B: Chuyển hướng đến Dashboard
    else Chưa đăng nhập
        SS-->>S: Session chưa có thông tin user
        S-->>B: Hiển thị form<br/>và trả PHPSESSID nếu vừa tạo session
        Note over B: Người dùng nhập tài khoản và mật khẩu

        B->>S: Gửi form đến process_login.php<br/>kèm PHPSESSID
        S->>SS: Mở session bằng PHPSESSID
        S->>S: Kiểm tra thông tin đăng nhập

        alt Thông tin đăng nhập đúng
            S->>SS: Lưu thông tin user vào session
            S-->>B: Chuyển hướng đến Dashboard
        else Thông tin đăng nhập sai
            S-->>B: Chuyển về form và hiển thị lỗi
        end
    end

    opt Khi người dùng đã đăng nhập
        B->>S: Truy cập trang cần đăng nhập<br/>kèm PHPSESSID
        S->>SS: Tìm session bằng PHPSESSID

        alt Session hợp lệ và có thông tin user
            SS-->>S: Trả thông tin user
            S-->>B: Hiển thị nội dung trang
        else Session không có hoặc đã hết hạn
            SS-->>S: Không tìm thấy thông tin user
            S-->>B: Chuyển hướng về trang đăng nhập
        end

        B->>S: Bấm đăng xuất
        S->>SS: Xóa session
        S-->>B: Xóa PHPSESSID và chuyển về trang đăng nhập
    end
```
