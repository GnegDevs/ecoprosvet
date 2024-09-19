package com.gnegdev.ecoprosvetcore.models;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.util.ArrayList;

@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class PageContent {
    private String news_header;
    private String news_preview;
    private String news_text;
}
