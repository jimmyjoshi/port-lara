<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/entities')) }}">
                <a href="{{ route('admin.entities.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Entity Manager</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/company')) }}">
                <a href="{{ route('admin.company.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Company Manager</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/key-contacts')) }}">
                <a href="{{ route('admin.key-contacts.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Key Contacts Manager</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/company-documents')) }}">
                <a href="{{ route('admin.company-documents.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Company Documents</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/company-notes')) }}">
                <a href="{{ route('admin.company-notes.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Company Notes</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/teams')) }}">
                <a href="{{ route('admin.teams.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Teams</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/team-members')) }}">
                <a href="{{ route('admin.team-members.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Teams Member</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/contacts')) }}">
                <a href="{{ route('admin.contacts.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Contacts</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/document-categories')) }}">
                <a href="{{ route('admin.document-categories.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Document Category Manager</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/uploads')) }}">
                <a href="{{ route('admin.uploads.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Upload Manager</span>
                </a>
            </li>

             <li class="{{ active_class(Active::checkUriPattern('admin/todos')) }}">
                <a href="{{ route('admin.todos.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>ToDo Manager</span>
                </a>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            @role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/permission*')) }}">
                        <a href="{{ route('admin.access.permission.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Permission Manager</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endauth

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>