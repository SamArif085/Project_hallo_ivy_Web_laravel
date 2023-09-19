 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         {{-- <li class="nav-item dropdown d-flex justify-content-center">
             <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                 style="margin-right: -20px">
                 <img src="icons/user-icons.png" alt="icon-profile" style="width: 40px">
             </a>
             <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="#">Logout</a></li>
             </ul>

         <li class="dropdown-header">
             <h6>Kevin Anderson</h6>
             <span>Web Designer</span>
         </li>
         </li> --}}

         {{-- <li class="nav-item">
             <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav --> --}}

         <li class="nav-item">
             <a class="nav-link {{ request()->routeIs('materi') ? '' : 'collapsed' }}" href="{{ route('materi') }}">
                 <i class="bi bi-journal-text"></i>
                 {{-- <div class="ml-3">
                     <img src="icons/material-icons.png" alt="" width="20px">
                 </div> --}}
                 <span>Materi</span>
             </a>
         </li><!-- End Profile Page Nav -->

         <li class="nav-item">
             <a class="nav-link {{ request()->routeIs('tugas') ? '' : 'collapsed' }}" href="{{ route('tugas') }}">
                 <i class="bi bi-journal-check"></i>
                 <span>Tugas Rumah</span>
             </a>
         </li><!-- End F.A.Q Page Nav -->

         {{-- <li class="nav-item">
             <a class="nav-link {{ request()->routeIs('pengumuman') ? '' : 'collapsed' }}" href="{{ route('pengumuman') }}">
                 <i class="bi bi-megaphone"></i>
                 <span>Pengumuman</span>
             </a>
         </li><!-- End Contact Page Nav --> --}}

     </ul>

 </aside><!-- End Sidebar-->
