<div class="sidebar-content">
    <!-- Main navigation -->
    <div class="sidebar-category sidebar-category-visible">
        <div class="sidebar-user-material">
            <div class="category-content">

                <div class="sidebar-user-material-menu">
                    <a href="#" data-toggle="collapse"><span>Himalaya Food Mantra</span> <i class=""></i></a>
                </div>
            </div>
        </div>

        <?php
        $currentRoute = Request::url();

        $explode = explode('/', $currentRoute);

        ?>

        <div class="category-content no-padding">
            <ul class="navigation navigation-main navigation-accordion">
                @foreach($modulesPermission as $modules)

                    <li @if($explode[4]==$modules['id']) class="active"
                       @endif>
                        @if($modules['pages']>1)
                            <a href="#sidenav{{$modules['id']}}" title="{{$modules['title']}}"
                               class="">

                                @else

                                    <a href="{{URL::to('system'."/".$modules['id'])}}">
                                        @endif
                                        <i class=" {{$modules['icon']}}"></i>
                                        <span>{{ ($modules['title']) }}</span>
                                    </a>


                                @if($modules['pages']>1)
                                    <ul id="sidenav{{$modules['id']}}">
                                        @foreach($modules['subPages'] as $pageId=>$pageTitle)
                                            <?php $url = 'system' . "/" . $pageId;?>
                                            <li @if($explode[4]==$pageId) class="active"
                                                    @endif ><a href="{{URL::to($url)}}" class="">{{ ($pageTitle) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                        @endif
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
    <!-- /main navigation -->

</div>
