console.log("some of MEEE");

import Vue, { VNode } from "vue";
import Component from "vue-class-component";

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

/**
 * Register Components
 */
Vue.component("my-component", MyComponent);
Vue.component("k", List);
Vue.component("user", User);

let App = new Vue({
    el: "#app",
    data: {
        title: "some Of Me",
        items: ["sdsd", "eeeexd", "rrrr"]
    }
});
