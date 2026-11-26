@php
    $bolehUbahData = $meja === null || auth()->user()->can('ubahDataMeja', $meja);
@endphp

@if ($errors->any())
    <div class="pesan error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@unless ($bolehUbahData)
    <div class="pesan">Peran Anda hanya boleh mengubah <strong>status</strong> meja.</div>
@endunless

<label>Nomor Meja</label>
<input type="text" name="nomor_meja" placeholder="Contoh: A01"
       value="{{ old('nomor_meja', $meja?->nomor_meja) }}" @disabled(! $bolehUbahData)>

<label>Kapasitas Kursi</label>
<select name="kapasitas" @disabled(! $bolehUbahData)>
    @foreach (\App\Models\Meja::DAFTAR_KAPASITAS as $k)
        <option value="{{ $k }}" @selected(old('kapasitas', $meja?->kapasitas) == $k)>{{ $k }} kursi</option>
    @endforeach
</select>

<label>Zona</label>
<select name="zona" @disabled(! $bolehUbahData)>
    @foreach (\App\Models\Meja::DAFTAR_ZONA as $z)
        <option value="{{ $z }}" @selected(old('zona', $meja?->zona) == $z)>{{ $z }}</option>
    @endforeach
</select>

<label>Status</label>
<select name="status">
    @foreach (\App\Models\Meja::DAFTAR_STATUS as $s)
        <option value="{{ $s }}" @selected(old('status', $meja?->status) == $s)>{{ $s }}</option>
    @endforeach
</select>