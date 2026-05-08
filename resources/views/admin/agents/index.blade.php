@extends('layouts.admin')
@section('title', 'Kelola Agen')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Kelola Agen</div>
        <div class="page-subtitle">Meet Our Agents — ditampilkan di halaman Tentang Kami</div>
    </div>
    <a href="{{ route('admin.agents.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Agen
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($agents->count())
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4 py-3">Foto</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Sosial Media</th>
                        <th>Urutan</th>
                        <th class="text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agents as $agent)
                    <tr>
                        <td class="px-4">
                            @if($agent->photo)
                                <img src="{{ asset('storage/' . $agent->photo) }}" style="width:50px;height:50px;object-fit:cover;border-radius:50%;border:2px solid var(--gold)" alt="">
                            @else
                                <div style="width:50px;height:50px;background:rgba(15,45,94,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-person" style="color:var(--primary)"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $agent->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ $agent->position ?? '-' }}</span></td>
                        <td>
                            <div class="d-flex gap-2">
                                @if($agent->facebook)  <a href="{{ $agent->facebook }}"  target="_blank" title="Facebook"><i class="bi bi-facebook text-primary"></i></a>@endif
                                @if($agent->twitter)   <a href="{{ $agent->twitter }}"   target="_blank" title="X/Twitter"><i class="bi bi-twitter-x text-dark"></i></a>@endif
                                @if($agent->linkedin)  <a href="{{ $agent->linkedin }}"  target="_blank" title="LinkedIn"><i class="bi bi-linkedin" style="color:#0077b5"></i></a>@endif
                                @if($agent->pinterest) <a href="{{ $agent->pinterest }}" target="_blank" title="Pinterest"><i class="bi bi-pinterest" style="color:#e60023"></i></a>@endif
                                @if($agent->whatsapp)  <a href="https://wa.me/{{ preg_replace('/\D/','',$agent->whatsapp) }}" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp text-success"></i></a>@endif
                                @if(!$agent->facebook && !$agent->twitter && !$agent->linkedin && !$agent->pinterest && !$agent->whatsapp)
                                    <span class="text-muted small">-</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $agent->sort_order }}</td>
                        <td class="text-end px-4">
                            <a href="{{ route('admin.agents.edit', $agent) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.agents.destroy', $agent) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus agen ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $agents->links() }}
        </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-person-badge text-muted" style="font-size:3rem;opacity:0.3"></i>
                <p class="text-muted mt-2">Belum ada agen. <a href="{{ route('admin.agents.create') }}">Tambah sekarang</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
