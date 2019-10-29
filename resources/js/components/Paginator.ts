import { Vue, Component } from "./vue";

@Component({
    props: {
        pageData: {
            type: Object,
            required: true
        }
    },
    template: require("./paginator.html")
})
export default class Paginator extends Vue {
    public pagesNums: Array<number | null> = [];

    public numberOfPages: number = 0;
    private current: number = 0;
    private from: number = 0;
    private to: number = 0;

    public afterCurrent: number = 0;
    public beforeCurrent: number = 0;

    public pagesList() {
        // get how many pages before current page
        this.beforeCurrent = this.current - 1;
        // limit before pages to current page minus 3 pages
        if (this.beforeCurrent > 3) this.beforeCurrent = this.current - 3;

        // console.log(this.beforeCurrent, this.afterCurrent);

        if (this.current === this.to) {
            return Array(this.current)
                .fill(0)
                .map((x, i) => i < this.current - 5 ? null : i + 1)
                .filter(x => x !== null);
        } else if (this.current === this.from) {
            return Array(6)
                .fill(0)
                .map((x, i) => i + 1)
                .filter(x => (x < this.to && x >= this.from));
        } else {
            return Array(7)
                .fill(0)
                .map((x, i) => i+this.beforeCurrent)
                .filter(x => x < this.to)
        }
    }

    public load(pageNum: number) {
        // check if trying to load negative pages or more than last page
        if (pageNum === this.current) {
            return false;
        }

        // @ts-ignore
        this.$root.loadPosts(pageNum, "posts");

        window.history.pushState(
            "posts page",
            "page " + pageNum,
            "/api/posts?page=" + pageNum
        );

        this.current = pageNum;

        this.pagesNums = this.pagesList();
    }

    mounted() {
        this.numberOfPages = this.$props.pageData.to;
        this.current = this.$props.pageData.current;
        this.from = this.$props.pageData.from;
        this.to = this.$props.pageData.to;

        this.pagesNums = this.pagesList();
    }
}
