<div id="app" class="container" v-on:keyup.esc='imageSrc = false'>
    <h2>@{{ title | capt }}</h2>
    <ul>
        <li v-for='i in items'>@{{i | uppercase}}</li>
    </ul>

    <div class="bg-dark text-light p-4 m-2 text-xl">
        <span v-if='!isNighty'>Morning</span>
        <span v-if='isNighty'>Night</span>

        <textarea class="mx-2 d-block"
            :class='{"bg-danger text-light": longText}' :maxlength="limit"
            v-model='memeText'></textarea>
    </div>

    <div class="bg-danger text-white p-3 m-2">
        <span v-if="new Date().getHours() < 9">goodMorning</span>
        <span v-else-if="new Date().getHours() < 16">goodAfterNoon</span>
        <span v-else>goodNight</span>
     </div> <article>
            They call me fruit.<br>
            They call me fish.<br>
            They call me insect.<br>
            But actually I'm not one of those.
            <div id="solution" v-on:click="showSolution = true">
                I am a
                <transition name='fade'>
                    <span id='dragon' class="text-warning p-1"
                        v-show='showSolution'>Dragon</span>
                </transition>
                </article>

                <form class="form" novalidate>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"
                                name="printer" id="printer"
                                v-model='printer' value="mono">
                            Mono
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"
                                name="printer" id="printer"
                                v-model='printer' value="poly">
                            Poly
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"
                                name="printer" id="printer"
                                v-model='printer' value="syco">
                            Syco
                        </label>
                    </div>
                    <span class="bg-dark text-danger p-2 m-4">
                        @{{printer}}
                    </span>
                    <div class="form-check">
                        Male<input type="radio" v-model='gender'
                            value="male" />
                        FeMale<input type="radio" v-model='gender'
                            value="female" />
                        </label>
                        <span
                            class="text-danger bg-dark">@{{gender}}</span>
                    </div>
                    <button type="submit"
                        v-on:click.submit.prevent>sub</button>
                </form>

                <div class="gallery col-sm-12">
                    <img v-for='img in imgs'
                        :src="'/res/img/' + img + '.png'"
                        class="col-6 col-sm-5"
                        v-on:click='imageSrc = img' />
                </div>

                <div v-if='imageSrc' class='modala text-light'>
                    <div class="d-relative">
                        <img :src="'/res/img/' + imageSrc + '.png'"
                            class="img img-responsive mx-auto" />
                        <button class="btn btn-block btn-danger"
                            v-on:click='imageSrc = false'>Close</button>
                    </div>
                </div>


                <anime :log='dialog'></anime>
                <button class="btn btn-primary btn-sm shadow"
                    v-on:click='superMe' ref='anm'>superMe</button>
                {{-- @{{refre}} --}}
                {{-- <anime :log='fruite'></anime> --}}

            </div>