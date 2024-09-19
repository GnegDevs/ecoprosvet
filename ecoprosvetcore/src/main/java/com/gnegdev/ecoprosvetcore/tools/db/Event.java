package com.gnegdev.ecoprosvetcore.tools.db;

public record Event(
        int id,
        String news_header,
        String news_preview,
        String news_text,
        String url
) {
}
