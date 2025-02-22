import scrapy


class SpiderWebSpider(scrapy.Spider):
    name = "spider_web"
    allowed_domains = ["spider_web.com"]
    start_urls = ["https://spider_web.com"]

    def parse(self, response):
        pass
