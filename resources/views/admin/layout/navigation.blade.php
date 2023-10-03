<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('admin.dashboard')}}" class="sidebar-brand">
            H-<span>Admin</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">HOMES</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">
                    <i class="link-icon" data-feather="grid"></i>
                    <span class="link-title">Categories</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="category">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.category.index')}}" class="nav-link">Category</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#amenity" role="button" aria-expanded="false" aria-controls="amenity">
                    <i class="link-icon" data-feather="film"></i>
                    <span class="link-title">Amenities</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="amenity">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.amenity.index')}}" class="nav-link">Amenity</a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#facility" role="button" aria-expanded="false" aria-controls="facility">
                    <i class="link-icon" data-feather="aperture"></i>
                    <span class="link-title">Facilities</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="facility">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.facility.index')}}" class="nav-link">Facility</a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#detail" role="button" aria-expanded="false" aria-controls="detail">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Details</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="detail">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.detail.index')}}" class="nav-link">Detail</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false" aria-controls="state">
                    <i class="link-icon" data-feather="life-buoy"></i>
                    <span class="link-title">States</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="state">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.state.index')}}" class="nav-link">State</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false" aria-controls="property">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Properties</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="property">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.property.index')}}" class="nav-link">property</a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.package.history.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Package History</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.property.message')}}" class="nav-link">
                    <i class="link-icon" data-feather="codepen"></i>
                    <span class="link-title">Message</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.testimonials.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Testimonials</span>
                </a>
            </li>

            <li class="nav-item nav-category">BLOGS</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#blog" role="button" aria-expanded="false" aria-controls="blog">
                    <i class="link-icon" data-feather="codesandbox"></i>
                    <span class="link-title">Blog</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="blog">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.blog-category.index')}}" class="nav-link"> Category</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.blog-post.index')}}" class="nav-link"> Post</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">BLOG POST COMMENTS</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#comments" role="button" aria-expanded="false" aria-controls="comments">
                    <i class="link-icon" data-feather="codesandbox"></i>
                    <span class="link-title">Comment</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="comments">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.blog-post-comment.index')}}" class="nav-link"> All Comments</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Authorization</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#accounts" role="button" aria-expanded="false" aria-controls="accounts">
                    <i class="link-icon" data-feather="lock"></i>
                    <span class="link-title">Manage Accounts</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="accounts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.users.index', ['role' => 'All'])}}" class="nav-link">All</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.index', ['role' => 'User'])}}" class="nav-link">User</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.index', ['role' => 'Admin'])}}" class="nav-link">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.index', ['role' => 'Agent'])}}" class="nav-link">Agent</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="nav-item nav-category">Roles and Permissions</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#roles_permissions" role="button" aria-expanded="false" aria-controls="roles_permissions">
                    <i class="link-icon" data-feather="shield"></i>
                    <span class="link-title">Permissions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="roles_permissions">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.permissions.index')}}" class="nav-link">All Permissions</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="nav-item nav-category">Site Settings</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#setting" role="button" aria-expanded="false" aria-controls="setting">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="setting">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.settings')}}" class="nav-link">Settings</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a href="pages/apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
            </li>


            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">UI Kit</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/badges.html" class="nav-link">Badges</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/breadcrumbs.html" class="nav-link">Breadcrumbs</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/buttons.html" class="nav-link">Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/button-group.html" class="nav-link">Button group</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/cards.html" class="nav-link">Cards</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/carousel.html" class="nav-link">Carousel</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/collapse.html" class="nav-link">Collapse</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/dropdowns.html" class="nav-link">Dropdowns</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/list-group.html" class="nav-link">List group</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/media-object.html" class="nav-link">Media object</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/modal.html" class="nav-link">Modal</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/navs.html" class="nav-link">Navs</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/navbar.html" class="nav-link">Navbar</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/pagination.html" class="nav-link">Pagination</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/popover.html" class="nav-link">Popovers</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/progress.html" class="nav-link">Progress</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/scrollbar.html" class="nav-link">Scrollbar</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/scrollspy.html" class="nav-link">Scrollspy</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/spinners.html" class="nav-link">Spinners</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/tabs.html" class="nav-link">Tabs</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/ui-components/tooltips.html" class="nav-link">Tooltips</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Advanced UI</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/sortablejs.html" class="nav-link">SortableJs</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/advanced-ui/sweet-alert.html" class="nav-link">Sweet Alert</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
