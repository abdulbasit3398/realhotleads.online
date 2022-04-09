<div class="vertical-menu">

  <div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        @if(\Auth::user()->type == 'admin')
        <li>
          <a href="{{route('admin.dashboard')}}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span key="t-starter-page">Admin Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('staff.dashboard')}}" class="waves-effect">
            <i class="bx bx-card"></i>
            <span key="t-starter-page">User contacts</span>
          </a>
        </li>


        <li>
          <a href="{{route('admin.user-withdrawal-request')}}" class="waves-effect">
            <i class="bx bx-card"></i>
            <span key="t-starter-page">User Withdrawal Request</span>
          </a>
        </li>
        @elseif(\Auth::user()->type == 'staff')
        <li>
          <a href="{{route('staff.dashboard')}}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span key="t-starter-page">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('staff.dashboard')}}" class="waves-effect">
            <i class="bx bx-card"></i>
            <span key="t-starter-page">User contacts</span>
          </a>
        </li>
              <li>
                  <a href="{{route('staff.custom-funnels')}}" class="waves-effect">
                      <i class="bx bxs-institution"></i>
                      <span key="t-starter-page">Custom Funnels</span>
                  </a>
              </li>

          <li>
              <a href="{{route('chat')}}" class="waves-effect">
                  <i class="bx bx-chat"></i>
                  <span key="t-chat">Support</span>
              </a>
          </li>

          <li>
              <a href="{{route('staff.sms-email-request')}}" class="waves-effect">
                  <i class="bx bx-chat"></i>
                  <span key="t-chat">Bulk SMS/Email Request</span>
              </a>
          </li>
        @else
        <!-- <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-share-alt"></i>
            <span key="t-multi-level">Dashboard</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li><a href="{{route('dashboard')}}" >Dashboard</a></li>
            <li><a href="{{route('user-contacts')}}" key="t-level-1-1">Contacts</a></li>

          </ul>
        </li> -->

        <li class="{{Request::route()->getName() == 'dashboard' || Request::route()->getName() == 'contacts' ? 'mm-active' : ''}}">
          <a href="{{route('dashboard')}}" class="has-arrow waves-effect">
            <i class="bx bx-home-circle"></i>
            <span key="t-multi-level">Dashboard</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li><a href="{{route('contacts')}}" key="t-level-1-1">Contacts</a></li>

          </ul>
        </li>

        <!-- <li>
          <a href="{{route('dashboard')}}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span key="t-starter-page">Dashboard</span>
          </a>
        </li> -->


        <li>
          <a href="{{route('pricing')}}" class="waves-effect">
            <i class="bx bx-dollar"></i>
            <span key="t-horizontal">Pricing</span>
          </a>
        </li>

        <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-share-alt"></i>
            <span key="t-multi-level">Resources</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li><a href="https://www.aiofunnel.site/training-courses/" key="t-level-1-1" target="_blank">Trainings and courses</a></li>
            <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Sales & marketing copy</a>
              <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);" key="t-level-2-1">Sales Copy</a></li>
                <li><a href="javascript: void(0);" key="t-level-2-2">Marketing Copy</a></li>
              </ul>
            </li>
            <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Scripts</a>
              <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);" key="t-level-2-1">Scripts 1</a></li>
                <li><a href="javascript: void(0);" key="t-level-2-2">Scripts 2</a></li>
              </ul>
            </li>
            <li><a href="{{route('under-construction')}}" key="t-level-1-1">Auto-responder templates</a></li>

          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-share-alt"></i>
            <span key="t-multi-level">Tools</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li><a href="{{route('contact-generator')}}" key="t-level-1-1">Contact Generator</a></li>
            <li><a href="{{route('list-cleaner')}}" key="t-level-1-1">List Cleaner</a></li>

            <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Communication</a>
              <ul class="sub-menu" aria-expanded="true">
                <li>
                  <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Core Module</a>
                  <ul class="sub-menu" aria-expanded="true">
                    <li><a href="{{route('communication-phone')}}" key="t-level-2-1">Phone</a></li>
                    <li><a href="{{route('communication-sms')}}" key="t-level-2-2">SMS</a></li>
                    <li><a href="{{route('communication-email')}}" key="t-level-2-3">Email</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Alt Modules</a>
                  <ul class="sub-menu" aria-expanded="true">
                    <li><a href="http://168.119.189.109/agc/vicidial.php" key="t-level-2-1">Phone 1</a></li>
                    <li><a href="https://135.181.195.194/index.php" key="t-level-1-1">Phone 2</a></li>
                    <li><a href="https://www.netelip.com/en/" key="t-level-1-1">Phone 3</a></li>
                    <li><a href="https://portal.goautodial.com/aff.php?aff=985" key="t-level-1-1">Phone 4</a></li>
                    <li><a href="https://auto-texter.website/" key="t-level-1-1">SMS</a></li>
                    <li><a href="{{route('under-construction')}}" key="t-level-1-1">Email</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Productivity</a>
              <ul class="sub-menu" aria-expanded="true">
                <li><a href="http://168.119.189.109/agc/vicidial.php" key="t-level-2-1">Calender</a></li>
                    <li><a href="https://135.181.195.194/index.php" key="t-level-1-1">Cloud Storage</a></li>


              </ul>
            </li>
            <li><a href="{{route('under-construction')}}" key="t-level-1-1">Logic Table</a></li>
            <!-- <li><a href="http://168.119.189.109/agc/vicidial.php" key="t-level-1-1">Phone 1</a></li> -->

            <!-- <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Scripts</a>
              <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);" key="t-level-2-1">Scripts 1</a></li>
                <li><a href="javascript: void(0);" key="t-level-2-2">Scripts 2</a></li>
              </ul>
            </li>
            <li><a href="{{route('under-construction')}}" key="t-level-1-1">Auto-responder templates</a></li> -->

          </ul>
        </li>

        <!-- <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-share-alt"></i>
            <span key="t-multi-level">Communications</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li><a href="http://168.119.189.109/agc/vicidial.php" key="t-level-1-1" target="_blank">Module 1</a></li>
            <li><a href="https://135.181.195.194/index.php" key="t-level-1-1" target="_blank">Module 2</a></li>
            <li><a href="https://www.netelip.com/en/" key="t-level-1-1" target="_blank">Module 3</a></li>
            <li><a href="https://portal.goautodial.com/aff.php?aff=985" key="t-level-1-1" target="_blank">Phone</a></li>
            <li><a href="https://auto-texter.website/" key="t-level-1-1" target="_blank">Text</a></li>
            <li><a href="{{route('under-construction')}}" key="t-level-1-1">Email</a></li>
          </ul>
        </li> -->

        <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-share-alt"></i>
            <span key="t-multi-level">Services</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <!-- <li><a href="{{route('contact-generator')}}" key="t-level-1-1">Contact Generator</a></li> -->
            <li><a href="{{route('sales-funnels')}}" target="_blank" key="t-level-1-1">Sales Funnels</a></li>
            <li><a href="{{route('ivr-rvm')}}" key="t-level-1-1">IVR & RVM</a></li>
            <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Virtual Assistance & Support Hub</a>
              <ul class="sub-menu" aria-expanded="true">
                <li><a href="javascript: void(0);" key="t-level-2-2">Time</a></li>
                    <li><a href="javascript: void(0);" key="t-level-2-1">Jobs</a></li>
                    <li><a href="javascript: void(0);" key="t-level-2-1">Work History</a></li>
                <!-- <li><a href="{{('dashboard')}}#ListTask" key="t-level-2-1">List Task</a></li> -->
              </ul>
            </li>

            <li>
              <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Email</a>
              <ul class="sub-menu" aria-expanded="true">
                <li><a href="{{route('auto-responder')}}" key="t-level-2-1">Auto Responder</a></li>
                    <li><a href="{{route('email-marketing')}}" key="t-level-2-2">Marketing</a></li>
                <!-- <li><a href="{{('dashboard')}}#ListTask" key="t-level-2-1">List Task</a></li> -->
              </ul>
            </li>

             <li><a href="{{route('under-construction')}}" key="t-level-1-1">Automation</a></li>
             <li><a href="{{route('sales-outsourcing')}}" key="t-level-1-1">Sales Outsourcing</a></li>
          </ul>
        </li>
        <!-- <li>
          <a href="{{route('calendar')}}" class="waves-effect">
            <i class="bx bx-calendar"></i>
            <span key="t-calendar">Calendar</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="{{route('file-manager')}}" class="waves-effect">
            <i class="bx bx-file"></i>
            <span key="t-file-manager">Cloud</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="{{route('create-project')}}" class="waves-effect">
            <i class="bx bx-briefcase-alt-2"></i>
            <span key="t-file-manager">Create Project</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
              <i class="bx bx-task"></i>
              <span key="t-tasks">Tasks</span>
          </a>
          <ul class="sub-menu mm-collapse" aria-expanded="false">
              <li><a href="{{route('task-list')}}" key="t-task-list">Task List</a></li>
              <li><a href="{{route('create-task')}}" key="t-create-task">Create Task</a></li>
          </ul>
        </li> -->
        <!-- <li>
          <a href="{{route('tables')}}" class="waves-effect">
            <i class="bx bx-briefcase-alt-2"></i>
            <span key="t-file-manager">Tables</span>
          </a>
        </li> -->
        <li>
          <a href="{{route('chat')}}" class="waves-effect">
            <i class="bx bx-chat"></i>
            <span key="t-chat">Chat</span>
          </a>
        </li>
        <!-- <li>
          <a href="{{route('user-contacts')}}" class="waves-effect">
            <i class="bx bxs-user-detail"></i>
            <span key="t-horizontal">Contacts</span>
          </a>
        </li> -->

        @endif
      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
