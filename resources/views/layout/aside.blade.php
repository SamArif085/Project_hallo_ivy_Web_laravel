 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">
         @if (Auth::user()->role == 2)
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('materi') ? '' : 'collapsed' }}" href="{{ route('materi') }}">
                     <i class="bi bi-journal-text"></i>
                     <span>Materi</span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('tugas') ? '' : 'collapsed' }}" href="{{ route('tugas') }}">
                     <i class="bi bi-journal-check"></i>
                     <span>Tugas Rumah</span>
                 </a>
             </li>
         @endif

         @if (Auth::user()->role == 1)
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('dataGuru') ? '' : 'collapsed' }}"
                     href="{{ route('dataGuru') }}">
                     <i class="bi bi-journal-check"></i>
                     <span>Data Guru</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('dataSiswa') ? '' : 'collapsed' }}"
                     href="{{ route('dataSiswa') }}">
                     <i class="bi bi-journal-check"></i>
                     <span>Data Siswa</span>
                 </a>
             </li>
         @endif
     </ul>

 </aside><!-- End Sidebar-->
