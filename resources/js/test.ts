console.log("some of MEEE");

import Vue, { VNode } from "vue";
import Component from "vue-class-component"
import * as Compo from './components/index'
import BootstrapVue from 'bootstrap-vue'


Vue.config.productionTip = false
Vue.use(BootstrapVue)

const SOME_THING_COOL = "some THing";

class Asd {
    protected name = "asdasd";
    protected val: number;

    public getName(): string {
        return this.name;
    }

    public setName(name: string): void {
        this.name = name;
    }

    public getVal(): number {
        return this.val;
    }
}

let myName = new Asd();

class B extends Asd {
    protected val = 53;

    public getName(): string {
        return super.getName();
    }
}

class C extends B {
    public setVal(num: number): void {
        this.val = num;
    }
}

console.log(myName.getName());

let c = new C();
c.setVal(253);
console.log(c.getVal());

class Base extends Vue {
    public name: string = "Some One Name Is Here";
}

@Component({
    // All component options are allowed in here
    template: '<button @click="onClick">Click!</button>'
})
class MyComponent extends Base {
    // Initial data can be declared as instance properties
    message: string = "Hello!";

    // Component methods can be declared as instance methods
    onClick(): void {
        window.alert(this.message);
        this.$el.textContent = 'some of Me'
    }
}

@Component({
    template: `
        <ul>
            <li v-for="i in list" @click="onClick(i)">{{ i }}</li>
            <li>{{ name }}</li>
        </ul>
    `
})
class List extends Base {
    private msg: string = "some thing";

    list: Array<string> = ["some", "ahm", "ads", "no here", "dead"];

    private onClick(name: string): void {
        alert(this.msg + " " + name);
    }
}

@Component({
    template: `
        <form class="form">
            <h4>{{ $data._asd }}</h4>
            <div class="form-group">
                <input class="form-control" v-model="title" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary">{{ title }}</button>
            </div>
            <h5>{{ name }}</h5>
        </form>
    `
})
class User extends Base {
    private _asd = "wsdsdxzx dd";

    public title = "submit";
    public user = "";
}



// @Component({
//     props: ['title'],
//     template: '<li>{{ title }}</li>'
// })
// class Ls extends Base
// {
//     public title: string;
// }

@Component({
    template: `
    <ul>
        <li v-for='n in count' @click='show()'>{{n}}</li>
    </ul>`,
    name: 'r'
})
class Test extends Base
{
    public count: Array<number> = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
    public counter = 10;

    public show() {
        alert('very GOOD');
    }
}

/**
 * Register Components
 */
// Vue.component("my-component", MyComponent)
// Vue.component("k", List)
// Vue.component("user", User)
// Vue.component("kk", Compo.List2)
// Vue.component("some", Compo.List3)
// Vue.component("stable", Compo.Table)
// Vue.component("ls", Ls)
// Vue.component('r', Test)

interface Student
{
    name: string
    dept?: string
    height: number
}

Vue.filter('json', (x) => {
    return x*13;
});

Vue.filter('capitalize', (str : string) => {
    let s = str.toString().split(' ')
    let output: Array<string> = []
    s.forEach((word: string) => {
        output.push(word.charAt(0).toUpperCase() + word.substr(1, word.length))
    })
    console.log(s)
    return output.join(' ');
});

let App = new Vue({
    el: "#app",
    data: {
        title: "some Of Me",
        items: ["sdsd", "eeeexd", "rrrr"],
        students: [
            {name: 'shm' + + Math.random() + 'asdw', dept: 'milk', height: Math.floor(Math.random() * 10)},
            {name: 'shm' + + Math.random() + 'asdw', dept: 'milk', height: Math.floor(Math.random() * 10)},{name: 'shm' + + Math.random() + 'asdw', dept: 'oljf', height: Math.floor(Math.random() * 10)},{name: 'shm' + + Math.random() + 'asdw', dept: 'milk', height: Math.floor(Math.random() * 10)},{name: 'shm' + + Math.random() + 'asdw', dept: 'asdw', height: Math.floor(Math.random() * 10)},{name: 'shm' + + Math.random() + 'asdw', dept: 'milk', height: Math.floor(Math.random() * 10)},
        ],
        names: [
            'ahmed',
            'adel',
            'some',
            'odnes',
            'asdajdk',
            'yehya'
        ],
        term: '',
        order: 'any',
        toOrder: 1,
        worlds: ['Terran', 'L24-D', 'Ares', 'New Kroy', 'Sebek', 'Vestra'],
        newWorld: '',
        isNight: false
    },
    computed: {
        nonDept() : Array<Student> {
            return this.students.filter(x => x !== 'milk')
        },
        list() : Array<string>  {
            return this.names.sort().filter(x => x.indexOf(this.term) > -1)
        },
        lessHight() : Array<Student> {
            return this.students.sort((s1, s2) => s1.height - s2.height * this.toOrder)
        },
        isNight() {
            return new Date().getHours() < 12
        }
    },
    methods: {
        ByName() : void {
            this.students.sort((s1, s2) => s1.name.substr(3, 9) - s2.name.substr(3, 9))
            this.order = 'name'
        },
        ByDept() : void {
            this.students.sort((s1, s2) => s1.dept.charCodeAt(0) - s2.dept.charCodeAt(0))
            this.order = 'dept'
        },
        ByHeight() : void {
            this.students.sort((s1, s2) => s1.height - s2.height)
            // this.toOrder = this.toOrder * -1
            this.order = 'height'
        }
    }
});

const nighty = new Vue({
    el: '#showhide',
    data: {
        isNight: false
    },
    computed: {
        isNight () : boolean {
            return new Date().getHours() < 12
        }
    }
})