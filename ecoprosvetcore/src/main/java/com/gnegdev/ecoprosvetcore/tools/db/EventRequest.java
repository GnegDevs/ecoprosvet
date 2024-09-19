package com.gnegdev.ecoprosvetcore.tools.db;

public record EventRequest(
        String news_header,
        String news_preview,
        String news_text,
        String url
) {
}
