@inject('Helpers','App\Lib\HelpersTemplates')

<div class="flexDashBoxs" id="flexDashBoxs">

    @if($user->settings->dash_welcome)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Bienvenue dans ton dashboard !','routeBox'=>route('subVueWelcomeUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_friend_cross)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les croix des potes','routeBox'=>route('subVueCroixPoteUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_photos)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les dernières photos postées','routeBox'=>route('subVuephotosLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_my_cross)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Mes croix','routeBox'=>route('subVueMesCroixUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_forum)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Derniers sujet du forum','routeBox'=>route('subVueForumLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_oblyk_news)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les news d\'Oblyk','routeBox'=>route('subVueNewsOblykUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_videos)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les dernières vidéos postées','routeBox'=>route('subVueVideosLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_crags)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les dernières falaises postées','routeBox'=>route('subVueCragsLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_comments)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les derniers commentaires postés','routeBox'=>route('subVueCommentsLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_routes)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les dernières lignes postées','routeBox'=>route('subVueRoutesLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_topos)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les derniers topos postés','routeBox'=>route('subVueToposLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_users)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les derniers grimpeurs arrivés','routeBox'=>route('subVueUsersLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_sae)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Les dernières salles ajoutées','routeBox'=>route('subVueSaeLastUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_list_crag_sae)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Liste des falaises et salles','routeBox'=>route('subVueListCragSaeUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_partenaire)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Ma recherche de partenaire','routeBox'=>route('subVuePartenaireUser', ['user_id'=>$user->id])])
    @endif

    @if($user->settings->dash_random_word)
        @include('pages.profile.vues.dashboardBox.box',['routeTitle'=>'Un mot au hasard','routeBox'=>route('subVueRandomWordUser', ['user_id'=>$user->id])])
    @endif

</div>