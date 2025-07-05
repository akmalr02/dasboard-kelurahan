<div class="header">
    <div class="logo">
        @if (file_exists(public_path('img/logo.png')))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo.png'))) }}"
                alt="Logo Kelurahan">
        @endif
    </div>
    <div class="header-text">
        <h1>Kelurahan Kramat-Senen</h1>
        <p>Kecamatan Senen, Jakarta Pusat - DKI Jakarta</p>
        <p>Telp: (021) 123-4567 | Email: kramat-senen@jakarta.go.id</p>
    </div>
</div>
