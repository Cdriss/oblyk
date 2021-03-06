{{--Materialize--}}
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

{{--Ficher Js commun à toutes les pages--}}
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript" src="/js/popup.js"></script>
<script type="text/javascript" src="/js/route.js"></script>
<script type="text/javascript" src="/js/router.js"></script>
<script type="text/javascript" src="/js/global-search.js"></script>
<script type="text/javascript" src="/framework/axios/axios.min.js"></script>
<script src="/framework/marked/marked.min.js"></script>
<script src="/framework/phototheque/phototheque.js"></script>
<script src="/framework/trumbowyg/trumbowyg.js"></script>
<script src="/framework/trumbowyg/plugins/trumbowyg.upload.js"></script>
<script type="text/javascript" src="/framework/trumbowyg/langs/fr.min.js"></script>
<script type="text/javascript" id="cookiebanner"
        src="/framework/cookiebanner/cookiebanner.min.js"
        data-height="32px" data-position="bottom"
        data-moreinfo="https://www.cnil.fr/fr/cookies-les-outils-pour-les-maitriser"
        data-linkmsg="en savoir plus"
        data-message='Oblyk utilise des cookies à des fins internes ou pour améliorer votre navigation, en continuant vous acceptez les <img rel="nofollow" alt="cookies" title="cookies" class="cookie-in-cookiebanner" src="/img/cookie.png">'>
</script>

<script type="text/javascript">
    {{--initialisation du paralax--}}
    $(document).ready(function(){

        $('.parallax').parallax();

        $(".button-open-global-search").sideNav({
            menuWidth: 400,
            edge: 'right',
            closeOnClick: false,
            draggable: false
        });
    });

    @if(Auth::check())
        //check s'il y a de nouveau message et notification
        getNewNotificationAndMessage();
    @endif

</script>

{{--inclusion de script particulier à une page--}}
@yield('script')
