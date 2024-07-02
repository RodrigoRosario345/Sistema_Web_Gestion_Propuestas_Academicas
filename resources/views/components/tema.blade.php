<div class="card-temas-list">
    <div class="flip-card">
        <div class="flip-card__container">
            <div class="card-front">
                <div class="card-front__tp card-front__tp--city">
                    <div class="enumeration-item">
                        <h1>{{ Helpers::enumarateModify($numeracion) }}</h1>
                    </div>
                    <h2 class="card-front__heading">
                        {{ $tipo }}
                    </h2>
                    <h3 class="card-front__subheading">
                        {{ $title }}
                    </h3>
                    <div class="step-wizard">
                        <ul class="step-wizard-list">
                            <li class=" {{ Helpers::verifyStateTema('Ninguno', $estado)}} " style="display: none;"></li> 
                            <li class="step-wizard-item {{ Helpers::verifyStateTema('Asignado', $estado)}}">
                                <span class="progress-count">1</span>
                                <span class="progress-label">Tema asignado</span>
                            </li>
                            <li class="step-wizard-item {{ Helpers::verifyStateTema('Perfil aprobado', $estado)}}">
                                <span class="progress-count">2</span>
                                <span class="progress-label">Perfil aprobado</span>
                            </li>
                            <li class="step-wizard-item {{ Helpers::verifyStateTema('Proyecto terminado', $estado)}}">
                                <span class="progress-count">3</span>
                                <span class="progress-label ">Proyecto terminado</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-front__bt">
                    <p class="card-front__text-view card-front__text-view--city">
                        Mírame
                    </p>
                </div>
            </div>
            <div class="card-back">
            </div>
        </div>
    </div>
    <div class="inside-page">
        <div class="inside-page__container">
            <div class="tema">
                <img src="images/page/{{ $logo }}">
                <div class="tema-header" style="background-color: var(--{{ $color }});"></div>
                <div class="main_data">
                    <div class="date">
                        {{ $date }}
                    </div>
                    <div class="trabajo_title">
                        {{ $title }}
                    </div>
                </div>
                <div class="sub_data">
                    <div class="data_label">
                        <i class="fa-solid fa-user-graduate" style="color: var(--grey); font-size:1vw"></i>
                        <div>Estudiante Asignado:</div>
                    </div>
                    <div class="data">{{ $author }}</div>
                    <div class="data_label">
                        <i class="fa-solid fa-user-tie" style="color: var(--grey); font-size:1vw"></i>
                        <div>Tutor:</div>
                    </div>
                    <div class="data">{{ $tutor }}</div>
                    <div class="data_label">
                        <i class="fa-solid fa-book-bookmark" style="color: var(--grey); font-size:1vw"></i>
                        <div>Modalidad propuesta:</div>
                    </div>
                    <div class="data">{{ $tipo }}</div>
                </div>
            </div>
            <button class="inside-page__btn inside-page__btn--{{ $sigla }} trabajo">
                <div style="display: none" class='id_trabajo'>{{ $id }}</div>
                Ver Detalles
            </button>
        </div>
    </div>
</div>