@extends('layouts.master')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-2xl shadow-xl p-7 mb-6 text-white border border-blue-300/40">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <div>
                <h1 class="text-3xl font-extrabold flex items-center gap-2">
                    📊 <span>Hasil Produk Pertanian</span>
                </h1>
                <p class="text-blue-100 mt-1">
                    Rekap panen 3 musim, total tahunan, foto, dan titik lokasi pertanian.
                </p>
            </div>

            <!-- FILTER -->
            <div class="flex gap-3">
                <select id="filterProduk"
                        class="rounded-xl px-4 py-2 bg-white text-gray-700 shadow focus:ring-2 focus:ring-yellow-300">
                    <option value="">Semua Produk</option>
                    <option value="Padi">Padi</option>
                    <option value="Polowijo">Polowijo</option>
                    <option value="Tebu">Tebu</option>
                </select>

                <select id="filterTahun"
                        class="rounded-xl px-4 py-2 bg-white text-gray-700 shadow focus:ring-2 focus:ring-yellow-300">
                    <option value="">Semua Tahun</option>
                    @foreach($data->pluck('tahun')->unique()->sortDesc() as $t)
                        <option value="{{ $t }}">{{ $t }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    <!-- TABEL -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-x-auto p-5 mb-4">
        <table id="tbl" class="w-full text-sm min-w-max">
            <thead>
                <tr class="bg-gray-100 text-gray-700 font-semibold">
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Dusun</th>
                    <th class="p-3 border">RT</th>
                    <th class="p-3 border">Tahun</th>
                    <th class="p-3 border">Produk</th>
                    <th class="p-3 border">Musim 1</th>
                    <th class="p-3 border">Musim 2</th>
                    <th class="p-3 border">Musim 3</th>
                    <th class="p-3 border text-green-700">Total (KG)</th>
                    <th class="p-3 border">Koordinat</th>
                    <th class="p-3 border">Foto</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $i => $row)
                <tr class="hover:bg-blue-50 transition">
                    <td class="p-3 border text-center">{{ $i+1 }}</td>
                    <td class="p-3 border capitalize">{{ $row->dusun }}</td>
                    <td class="p-3 border text-center">{{ $row->rt }}</td>

                    <td class="p-3 border text-center font-semibold text-blue-700">{{ $row->tahun }}</td>
                    <td class="p-3 border text-center">{{ $row->produk }}</td>

                    <td class="p-3 border text-right">{{ number_format($row->musim_1 ?? 0) }}</td>
                    <td class="p-3 border text-right">{{ number_format($row->musim_2 ?? 0) }}</td>
                    <td class="p-3 border text-right">{{ number_format($row->musim_3 ?? 0) }}</td>

                    <td class="p-3 border text-right font-bold text-green-700">{{ number_format($row->total_tahun ?? 0) }}</td>

                    <!-- KOORDINAT -->
                    <td class="p-3 border text-center">
                        @if($row->koordinat)
                            <a href="https://www.google.com/maps?q={{ $row->koordinat }}"
                               target="_blank"
                               class="bg-blue-600 text-white px-3 py-1 rounded shadow hover:bg-blue-700 transition">
                                Lihat Lokasi
                            </a>
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>

                    <!-- FOTO -->
                    <td class="p-3 border text-center">
                        @if($row->foto)
                            <img src="{{ asset('storage/'.$row->foto) }}"
                                 class="w-14 h-14 object-cover rounded-lg shadow cursor-pointer hover:scale-105 transition"
                                 onclick="openLightbox('{{ asset('storage/'.$row->foto) }}')">
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $data->links('pagination::tailwind') }}
    </div>

    <!-- GRAFIK -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mt-6">
        <h3 class="text-xl font-bold mb-4 flex items-center gap-2 text-gray-800">
            📈 Grafik Total Panen per Tahun
        </h3>
        <canvas id="panenChart" height="140"></canvas>
    </div>

</div>

<!-- LIGHTBOX -->
<div id="lightbox"
     class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">
    <button onclick="closeLightbox()"
        class="absolute top-6 right-8 text-white hover:text-red-300 transition">
        ✖
    </button>
    <img id="lightbox-img"
         class="max-w-[90vw] max-h-[90vh] rounded-xl opacity-0 scale-95 transition">
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* LIGHTBOX */
function openLightbox(src) {
    const box = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");
    img.src = src;
    box.classList.remove("hidden");
    box.classList.add("flex");
    setTimeout(() => img.classList.remove("opacity-0","scale-95"), 50);
}
function closeLightbox() {
    const box = document.getElementById("lightbox");
    const img = document.getElementById("lightbox-img");
    img.classList.add("opacity-0","scale-95");
    setTimeout(() => { box.classList.add("hidden"); img.src=''; }, 150);
}

/* FILTER TABEL */
document.getElementById('filterProduk').addEventListener('change', applyFilter);
document.getElementById('filterTahun').addEventListener('change', applyFilter);

function applyFilter() {
    const prod = document.getElementById('filterProduk').value;
    const year = document.getElementById('filterTahun').value;

    document.querySelectorAll('#tbl tbody tr').forEach(row => {
        const rProd = row.children[4].innerText.trim();
        const rYear = row.children[3].innerText.trim();
        row.style.display = (
            (!prod || prod === rProd) &&
            (!year || year === rYear)
        ) ? "" : "none";
    });
}

/* GRAFIK */
const raw = @json(
    $data->map(fn($r) => [
        "tahun"  => (string)$r->tahun,
        "produk" => $r->produk,
        "total"  => (int)$r->total_tahun
    ])
);

const years = [...new Set(raw.map(r => r.tahun))].sort();
const products = ['Padi','Polowijo','Tebu'];

const ctx = document.getElementById('panenChart').getContext('2d');

function gradient(c1,c2){
    let g = ctx.createLinearGradient(0,0,0,300);
    g.addColorStop(0,c1); g.addColorStop(1,c2);
    return g;
}

const grad = {
    Padi: gradient('rgba(34,197,94,0.7)','rgba(34,197,94,0)'),
    Polowijo: gradient('rgba(59,130,246,0.7)','rgba(59,130,246,0)'),
    Tebu: gradient('rgba(234,88,12,0.7)','rgba(234,88,12,0)')
};

new Chart(ctx,{
    type:"line",
    data:{
        labels:years,
        datasets: products.map(p=>({
            label:p,
            data: years.map(y=>raw.filter(r=>r.tahun===y && r.produk===p)
                     .reduce((n,c)=>n+c.total,0)),
            borderColor:grad[p],
            backgroundColor:grad[p],
            fill:true,
            tension:.35,
            borderWidth:3,
            pointRadius:5,
            pointBackgroundColor:"#fff"
        }))
    },
    options:{
        plugins:{ legend:{ labels:{ font:{ size:12 } } }},
        scales:{
            y:{ beginAtZero:true,
                ticks:{ callback:v=>v.toLocaleString()+" kg" }
            }
        }
    }
});
</script>

@endsection
