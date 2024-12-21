<!-- .htaccess -->
    Options -Multiviews
    Mencegah Apache menebak atau mengubah URL jika tidak ada file yang cocok. Misalnya, jika Anda mengetik example.com/about, Apache tidak akan mencari file bernama about.html.

    RewriteEngine On
    Mengaktifkan fitur rewrite rules untuk memodifikasi URL yang diminta.

    RewriteCond %{REQUEST_FILENAME} !-d
    Jika URL yang diminta bukan direktori, lanjutkan ke aturan berikutnya.

    RewriteCond %{REQUEST_FILENAME} !-f
    Jika URL yang diminta bukan file, lanjutkan ke aturan berikutnya.

    RewriteRule ^(.*)$ index.php?url=$1
    Mengarahkan semua URL yang tidak cocok dengan file atau direktori yang ada ke index.php.
    Tujuannya agar aplikasi dapat menangani URL seperti /produk/123 melalui kode PHP dengan nilai url=produk/123.