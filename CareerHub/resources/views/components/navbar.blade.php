<nav class="navbar sticky top-0 shadow-md bg-white z-10 ">
  <div class="container mx-auto flex justify-between items-center">
    <div class="flex gap-8 items-center">
      <a href="{{ route('dashboard') }}" class="font-bold text-2xl h-fit text-black cursor-pointer">CareerHub</a>
      <label class="input input-bordered w-[35vw] h-fit py-2 max-w-96 flex items-center gap-2">
        <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="opacity-70">
          <path fill-rule="evenodd"
            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
            clip-rule="evenodd" />
        </svg>
        <input type="text" class="grow" placeholder="Search" />
      </label>
    </div>
    <div class="flex gap-8 items-center">
      <b>Company</b>
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img alt="Profile Picture"
              src="{{ Auth::user()->profile_link ?? '/assets/profile-empty.png' }}" />
          </div>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content bg-white rounded-md z-[1] mt-3 w-24 shadow">
          <a href="{{ route('profile') }}"
            class="flex justify-between items-center px-2 mb-2 hover:bg-gray-300 transition-colors">
            <svg width="1em" height="1em" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink">
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Dribbble-Light-Preview" transform="translate(-420.000000, -2159.000000)" fill="#000000">
                  <g id="icons" transform="translate(56.000000, 160.000000)">
                    <path
                      d="M374,2009 C371.794,2009 370,2007.206 370,2005 C370,2002.794 371.794,2001 374,2001 C376.206,2001 378,2002.794 378,2005 C378,2007.206 376.206,2009 374,2009 M377.758,2009.673 C379.124,2008.574 380,2006.89 380,2005 C380,2001.686 377.314,1999 374,1999 C370.686,1999 368,2001.686 368,2005 C368,2006.89 368.876,2008.574 370.242,2009.673 C366.583,2011.048 364,2014.445 364,2019 L366,2019 C366,2014 369.589,2011 374,2011 C378.411,2011 382,2014 382,2019 L384,2019 C384,2014.445 381.417,2011.048 377.758,2009.673"
                      id="profile-[#1335]">
                    </path>
                  </g>
                </g>
              </g>
            </svg>
            <p>Profile</p>
          </a>
          <a href="{{ url('/logout') }}" class="flex justify-between items-center px-2 hover:bg-gray-300">
            <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M21 12L13 12" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9"
                stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19"
                stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>Logout</p>
          </a>
        </ul>
      </div>
    </div>
  </div>
</nav>
