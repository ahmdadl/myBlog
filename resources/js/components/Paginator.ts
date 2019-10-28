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
    public pagesNums: Array<number> = [] 

    public numberOfPages: number = 0;
    private current: number = 0
    private from: number = 0
    private to: number = 0

    public afterCurrent: number = 0
    public beforeCurrent: number = 0

    public pagesList() {
        // get how many pages before current page
        this.beforeCurrent = this.current - 1
        // limit before pages to current page minus 3 pages
        if (this.beforeCurrent > 3) this.beforeCurrent=this.current-3

        // calculate how many pages after current
        this.afterCurrent = this.to - this.current
        // limit after pages to 4
        if (this.afterCurrent > 4) this.afterCurrent = this.current+4


        console.log(this.beforeCurrent, this.afterCurrent)

        return Array(this.afterCurrent - this.beforeCurrent).fill(1).map((x, i) => {
            return i+this.beforeCurrent+1
        })
    }

    public load(pageNum: number) : void {
        this.$root.loadPosts(pageNum, 'posts')
        
        window.history.pushState('posts page', 'page ' + pageNum, '/api/posts?page=' + pageNum)

        this.current = pageNum

        this.pagesNums = this.pagesList()
    }

    mounted () {
        this.numberOfPages = this.pageData.to
        this.current = this.pageData.current;
        this.from = this.pageData.from;
        this.to = this.pageData.to;
        
        this.pagesNums = this.pagesList()
    }
}
