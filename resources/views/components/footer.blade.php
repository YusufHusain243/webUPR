<footer id="footer" class="footer" style="background-color: {{ isset($setting[0]->color) ? $setting[0]->color : '#043507' }}">
    <div class="footer-content">
        <div class="container"
            style='color: #FFFFFF!important;
            font-family: "Rokkitt", Sans-serif !important;
            font-size: 14px;
            font-weight: 400;'>
            <div class="row">
                <div class="col-lg-2">
                    <img src="{{ asset('image/blunew.png') }}" alt="Blue" style="max-height:90px">
                </div>
                <div class="col-lg-3">
                    <h3 class="footer-heading">CONTACT US</h3>
                    <p>
                        @if (session('locale') !== null && session('locale') == 'id')
                            <b>KAMPUS UPR TANJUNG NYAHO</b><br>
                            Jln. Yos Sudarso Palangka Raya
                            73111, Kalimantan Tengah<br>
                            Email: {{ isset($setting[0]) ? $setting[0]->email : '' }}<br>
                            Whatsapp:  {{ isset($setting[0]) ? $setting[0]->wa : '' }}
                        @else
                            <b>UPR TANJUNG NYAHO CAMPUS</b><br>
                            Streets Yos Sudarso, Palangka Raya 73111, Central Borneo <br>
                            Email: info@upr.ac.id <br>
                            Whatsapp:
                        @endif
                    </p>
                </div>
                <div class="col-lg-4">
                    <h3 class="footer-heading">
                        {{ session('locale') !== null && session('locale') == 'id' ? 'FAKULTAS' : 'FACULTIES' }}</h3>
                    <ul class="footer-links list-unstyled">
                        <li>
                            <a href="https://fkip.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN
                                @else
                                    FACULTY OF TEACHER TRAINING AND EDUCATION
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://feb.upr.ac.id">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS EKONOMI & BISNIS
                                @else
                                    FACULTY OF ECONOMICS
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://faperta.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS PERTANIAN
                                @else
                                    FACULTY OF AGRICULTURE
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://ft.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS TEKNIK
                                @else
                                    FACULTY OF ENGINEERING
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://fh.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS HUKUM
                                @else
                                    FACULTY OF LAW
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://fisip.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS ILMU SOSIAL DAN POLITIK
                                @else
                                    FACULTY OF SOCIAL AND POLITICAL SCIENCES
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://medical.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS KEDOKTERAN
                                @else
                                    MEDICAL SCHOOL
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://fmipa.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM
                                @else
                                    FACULTY OF MATHEMATICS AND SCIENCE
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="https://pps.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>

                                @if (session('locale') !== null && session('locale') == 'id')
                                    PROGRAM PASCA SARJANA
                                @else
                                    GRADUATE PROGRAM
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3 class="footer-heading">
                        @if (session('locale') !== null && session('locale') == 'id')
                            UNIT PELAYANAN TEKNIS & LEMBAGA
                        @else
                            TECHNICAL SERVICE UNITS & INSTITUTIONS
                        @endif
                    </h3>
                    <ul class="footer-links list-unstyled">
                        <li>
                            <a href="https://tik.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    UPT. TIK
                                @else
                                    TECHNOLOGY TSU.
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="https://uptbahasaupr.wordpress.com/">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    UPT. BAHASA
                                @else
                                    LANGUAGE TSU.
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="http://lib.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    UPT. PERPUSTAKAAN
                                @else
                                    LIBRARY TSU.
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="https://www.upr.ac.id/#">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    UPT. LAB LAHAN GAMBUT
                                @else
                                    PEATLAND LABORATORY TSU.
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="http://laboratorium-terpadu.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    UPT. LAB TERPADU
                                @else
                                    INT LABORATORY TSU.
                                @endif

                            </a>
                        </li>
                        <li>
                            <a href="https://lppm.upr.ac.id/">
                                <i class="bi bi-chevron-right"></i>
                                @if (session('locale') !== null && session('locale') == 'id')
                                    LPPM
                                @else
                                    LPPM
                                @endif

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-legal">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="credits" style="color:black">
                        © Copyright <strong><span>IT UPT TIK UPR</span></strong>. All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
