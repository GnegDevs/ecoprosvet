package com.gnegdev.ecoprosvetcore.tools.parser;

import java.time.Duration;
import com.gnegdev.ecoprosvetcore.models.PageContent;
import com.gnegdev.ecoprosvetcore.tools.db.EventRequest;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.nodes.Node;
import org.jsoup.select.Elements;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;


import java.io.IOException;
import java.util.ArrayList;


public class ParserClient {
    public static ArrayList<EventRequest> parseMosRuNews(int page) throws IOException {
        String url = "https://www.mos.ru/search/newsfeed?hostApplied=false&page=" + page + "&spheres=7299&types=news&q=форумы";

        WebDriver driver = new ChromeDriver();

        driver.manage().timeouts().implicitlyWait(Duration.ofSeconds(5));
        driver.manage().timeouts().pageLoadTimeout(Duration.ofSeconds(5));
        driver.manage().timeouts().scriptTimeout(Duration.ofSeconds(5));

        driver.get(url);

        Document doc = Jsoup.parse(driver.getPageSource());

        Elements r = doc.getElementsByClass("css-138qemu-Text");
        Elements hrefContent = doc.getElementsByClass("css-1wpb4ha-Box-Link-Text");

        ArrayList<EventRequest> pagesContent = new ArrayList<EventRequest>();

        for (Element href : hrefContent) {
            pagesContent.add(parseMosRuNewsPage(href.attr("href")));
        }

        return pagesContent;
    }
    public static EventRequest parseMosRuNewsPage(String url) throws IOException {
        Document doc = Jsoup.connect(url).get();
        Elements newsArticle = doc.getElementsByClass("news-article-title-container__title");
        Elements newsPreview = doc.getElementsByClass("news-article__preview");
        Elements newsContent = doc.getElementsByClass("content-text");

        StringBuilder newsTextContent = new StringBuilder();

        for (Element textContent : newsContent) {
            for (Node textElement : textContent.childNodes()) {
                if (textElement instanceof Element) {
                    newsTextContent.append(((Element) textElement).text());
                    newsTextContent.append("\n");
                }
            }
        }

        return new EventRequest(newsArticle.text(), newsPreview.text(), newsTextContent.toString(), url);
    }

    public static void main(String[] args) throws IOException {
        /*
        PageContent data = parseMosRuNewsPage("https://www.mos.ru/news/item/141876073/");

        System.out.println(data.getHeader().toString());

        for (String section: data.getContent()) {
           System.out.println("\n" + section);
        }*/
        parseMosRuNews(3);
    }
}
