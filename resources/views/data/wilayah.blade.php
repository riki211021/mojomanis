@extends('layouts.master')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Hero --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-8 rounded-2xl shadow-lg">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">
                Data Demografi Berdasar Populasi Per Wilayah
            </h1>
            <p class="text-blue-100">Statistik penduduk berdasarkan Dusun, RW, dan RT di Desa Mojomanis</p>
        </div>

        {{-- Table --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg overflow-x-auto">
            <table class="w-full border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-200 text-black text-center font-bold">
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border text-left">Wilayah / Ketua</th>
                        <th class="px-4 py-2 border">KK</th>
                        <th class="px-4 py-2 border">L+P</th>
                        <th class="px-4 py-2 border">L</th>
                        <th class="px-4 py-2 border">P</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @php $totalKK=0; $totalL=0; $totalP=0; @endphp

                    @foreach($dusun as $i => $d)
                        @php
                            $totalKK += $d->kk;
                            $totalL += $d->l;
                            $totalP += $d->p;
                        @endphp

                        {{-- Dusun --}}
                        <tr class="bg-gray-100 font-semibold">
                            <td class="border text-center">{{ $i+1 }}</td>
                            <td class="border px-4">Dusun {{ $d->nama }} , Ketua {{ $d->ketua }}</td>
                            <td class="border text-center">{{ $d->kk }}</td>
                            <td class="border text-center">{{ $d->l + $d->p }}</td>
                            <td class="border text-center">{{ $d->l }}</td>
                            <td class="border text-center">{{ $d->p }}</td>
                        </tr>

                        {{-- RW --}}
                        @foreach($d->children as $rw)
                            <tr>
                                <td></td>
                                <td class="border pl-8">RW {{ $rw->nama }} , Ketua {{ $rw->ketua }}</td>
                                <td class="border text-center">{{ $rw->kk }}</td>
                                <td class="border text-center">{{ $rw->l + $rw->p }}</td>
                                <td class="border text-center">{{ $rw->l }}</td>
                                <td class="border text-center">{{ $rw->p }}</td>
                            </tr>

                            {{-- RT --}}
                            @foreach($rw->children as $rt)
                                <tr>
                                    <td></td>
                                    <td class="border pl-16">RT {{ $rt->nama }} , Ketua {{ $rt->ketua }}</td>
                                    <td class="border text-center">{{ $rt->kk }}</td>
                                    <td class="border text-center">{{ $rt->l + $rt->p }}</td>
                                    <td class="border text-center">{{ $rt->l }}</td>
                                    <td class="border text-center">{{ $rt->p }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>

                {{-- TOTAL --}}
                <tfoot>
                    <tr class="bg-red-600 text-white font-bold text-center">
                        <td colspan="2" class="px-4 py-2">TOTAL</td>
                        <td class="px-4 py-2">{{ $totalKK }}</td>
                        <td class="px-4 py-2">{{ $totalL + $totalP }}</td>
                        <td class="px-4 py-2">{{ $totalL }}</td>
                        <td class="px-4 py-2">{{ $totalP }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
