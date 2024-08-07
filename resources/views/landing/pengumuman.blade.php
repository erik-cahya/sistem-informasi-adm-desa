@extends('landing.layouts.main1')

@section('container')
    <style>
        /* If the screen size is 1200px wide or more, set the font-size to 80px */
        @media (min-width: 1200px) {
            .responsive-header {
                font-size: 64px;
            }

            .responsive-header1 {
                font-size: 50px;
            }

            .responsive-p {
                font-size: 24px;
            }

            .responsive-p1 {
                font-size: 22px;
            }

            .responsive-mini {
                font-size: 20px
            }

            .responsive-small {
                font-size: 16px
            }
        }

        /* If the screen size is smaller than 1200px, set the font-size to 80px */
        @media (max-width: 1199.98px) {
            .responsive-header {
                font-size: 40px;
            }

            .responsive-header1 {
                font-size: 30px;
            }

            .responsive-p {
                font-size: 16px;
            }

            .responsive-p1 {
                font-size: 14px;
            }

            .responsive-mini {
                font-size: 14px
            }
        }
    </style>
    <style>
        /* Typewriter effect 1 */
        @keyframes typing {

            0%,
            1% {
                content: "";
            }

            1%,
            2% {
                content: "S";
            }

            2%,
            3% {
                content: "Se";
            }

            3%,
            4% {
                content: "Sel";
            }

            4%,
            5% {
                content: "Sela";
            }

            5%,
            6% {
                content: "Selam";
            }

            6%,
            7% {
                content: "Selamat";
            }

            7%,
            8% {
                content: "Selamat Da";
            }

            8%,
            9% {
                content: "Selamat Data";
            }

            10%,
            25% {
                content: "Selamat Datang";
            }

            52%,
            55% {
                content: "";
            }

            56%,
            57% {
                content: "W";
            }

            58%,
            59% {
                content: "We";
            }

            60%,
            61% {
                content: "Web";
            }

            62%,
            63% {
                content: "Webs";
            }

            64%,
            65% {
                content: "Webs";
            }

            66%,
            67% {
                content: "Websi";
            }

            68%,
            69% {
                content: "Website";
            }

            70%,
            71% {
                content: "Website D";
            }

            72%,
            73% {
                content: "Website De";
            }

            74%,
            75% {
                content: "Website Des";
            }

            76%,
            77% {
                content: "Website Desa";
            }

            78%,
            79% {
                content: "Website Desa R";
            }

            80%,
            81% {
                content: "Website Desa Ra";
            }

            82%,
            83% {
                content: "Website Desa Ran";
            }

            84%,
            85% {
                content: "Website Desa Rant";
            }

            86%,
            87% {
                content: "Website Desa Ranta";
            }

            88%,
            89% {
                content: "Website Desa Rantau";
            }

            90%,
            91% {
                content: "Website Desa Rantau P";
            }

            92%,
            93% {
                content: "Website Desa Rantau Pu";
            }

            94%,
            95% {
                content: "Website Desa Rantau Pur";
            }

            96%,
            100% {
                content: "Website Desa Rantau Puri";
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .typewriter {
            --caret: currentcolor;
        }

        .typewriter::before {
            content: "";
            animation: typing 13.5s infinite;
        }

        .typewriter::after {
            content: "";
            border-right: 1px solid var(--caret);
            animation: blink 0.5s linear infinite;
        }

        .typewriter.thick::after {
            border-right: 1ch solid var(--caret);
        }

        .typewriter.nocaret::after {
            border-right: 0;
        }


        @media (prefers-reduced-motion) {
            .typewriter::after {
                animation: none;
            }

            @keyframes sequencePopup {

                0%,
                100% {
                    content: "Selamat Datang!";
                }

                25% {
                    content: "E-Learning Bank Bengkulu";
                }

                50% {
                    content: "reader";
                }

                75% {
                    content: "human";
                }
            }

            .typewriter::before {
                content: "Selamat Datang!";
                animation: sequencePopup 12s linear infinite;
            }
        }
    </style>
    <style>
        a:hover {
            color: #0e9313;
        }

        a {
            color: #064708;
            text-decoration: none;
        }
    </style>
    <br><br><br><br>
    <div class="py-1 py-xl-1 px-md-5 px-sm-0 mx-5">
        <div class="m-md-5 m-sm-4 px-md-2 px-sm-0">
            <div class="card text-bg-light mb-3">
                <div class="card-body">
                    <a href="/">
                        <svg fill="#000000" width="18px" height="18px" viewBox="-4.5 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>home</title>
                                <path
                                    d="M19.469 12.594l3.625 3.313c0.438 0.406 0.313 0.719-0.281 0.719h-2.719v8.656c0 0.594-0.5 1.125-1.094 1.125h-4.719v-6.063c0-0.594-0.531-1.125-1.125-1.125h-2.969c-0.594 0-1.125 0.531-1.125 1.125v6.063h-4.719c-0.594 0-1.125-0.531-1.125-1.125v-8.656h-2.688c-0.594 0-0.719-0.313-0.281-0.719l10.594-9.625c0.438-0.406 1.188-0.406 1.656 0l2.406 2.156v-1.719c0-0.594 0.531-1.125 1.125-1.125h2.344c0.594 0 1.094 0.531 1.094 1.125v5.875z">
                                </path>
                            </g>
                        </svg></a> / Pengumuman
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2 style="color:#064708;"><b>Pengumuman</b></h2>
                    <hr style="border: 1px solid green;
                    border-radius: 5px;">
                    <table class="table table-hover table-responsive">
                        <tbody>
                            @foreach ($announces as $announce)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <div class="card mb-3" data-bss-hover-animate="pulse">
                                            <div class="row g-0">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><a
                                                                href="pengumuman/read/{{ $announce->id }}">{{ $announce->judul }}</a>
                                                        </h5>
                                                        <div class="row"
                                                            style="text-align: justify;text-justify: inter-word;">
                                                            <div class="col-3">
                                                                <p><svg width="16px" height="16px" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                            stroke-linejoin="round"></g>
                                                                        <g id="SVGRepo_iconCarrier">
                                                                            <path
                                                                                d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                                stroke="#000000" stroke-width="2"
                                                                                stroke-linecap="round">
                                                                            </path>
                                                                            <rect x="6" y="12"
                                                                                width="3" height="3" rx="0.5"
                                                                                fill="#000000">
                                                                            </rect>
                                                                            <rect x="10.5" y="12"
                                                                                width="3" height="3" rx="0.5"
                                                                                fill="#000000">
                                                                            </rect>
                                                                            <rect x="15" y="12"
                                                                                width="3" height="3" rx="0.5"
                                                                                fill="#000000">
                                                                            </rect>
                                                                        </g>
                                                                    </svg> {{ $announce->created_at }}
                                                                </p>
                                                            </div>
                                                            <div class="col-9 float-left">
                                                                <p><svg width="16px" height="16px" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                            stroke-linejoin="round"></g>
                                                                        <g id="SVGRepo_iconCarrier">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z"
                                                                                fill="#000000"></path>
                                                                        </g>
                                                                    </svg> {{ $announce->creator }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">{!! \Illuminate\Support\Str::limit($announce->pengumuman, 150, $end = '...') !!}<a
                                                                href="pengumuman/read/{{ $announce->id }}"><br><b>Selengkapnya
                                                                    ></b></a>
                                                        </p>
                                                        <p class="card-text"><small class="text-body-secondary">Last updated
                                                                {{ $announce->created_at->diffForHumans() }}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                {{ $announces->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
