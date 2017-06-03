<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width crag-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span>Informations</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueFilActuCrag',[$crag->id])}}" class="router-link" href="#fil-actu"><i class="material-icons">shuffle</i><span>Fil d'actu</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueSecteurCrag',[$crag->id])}}" data-callback="getSectorChart" class="router-link" href="#voies"><i class="material-icons">format_list_bulleted</i><span>Secteurs &amp; Voies</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueMediasCrag',[$crag->id])}}" class="router-link" href="#medias"><i class="material-icons">collections</i><span>Médias</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueLiensCrag',[$crag->id])}}" class="router-link" href="#liens"><i class="material-icons">link</i><span>Liens</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueToposCrag',[$crag->id])}}" class="router-link" href="#topos"><i class="material-icons">local_library</i><span>Topos</span></a></li>
            <li class="tab col s2"><a data-route="{{route('vueMapCrag',[$crag->id])}}" data-callback="initCragMap" class="router-link" href="#map"><i class="material-icons">map</i><span>Map</span></a></li>
        </ul>
    </div>
</div>