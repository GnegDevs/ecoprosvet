package com.gnegdev.ecoprosvetcore.tools.db;


import org.springframework.jdbc.core.namedparam.MapSqlParameterSource;
import org.springframework.jdbc.core.namedparam.NamedParameterJdbcTemplate;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.Optional;

@Repository
public class EventRepositoryImpl implements EventRepo {

    private static final String SQL_GET_EVENT_BY_ID =
            "select id, news_header, news_preview, news_text, url from event where id = :id";
    private static final String SQL_GET_EVENTS =
            "select id, news_header, news_preview, news_text, url from event";
    private static final String SQL_INSERT_EVENT =
            "insert into event (news_header, news_preview, news_text, url) values (:news_header, :news_preview, :news_text, :url)";


    private final EventMapper eventMapper;
    private final NamedParameterJdbcTemplate jdbcTemplate;

    public EventRepositoryImpl(
            EventMapper eventMapper,
            NamedParameterJdbcTemplate jdbcTemplate
    ) {
        this.eventMapper = eventMapper;
        this.jdbcTemplate = jdbcTemplate;
    }

    @Override
    public Optional<List<Event>> getEvents() {
        return Optional.of(jdbcTemplate.query(
                SQL_GET_EVENTS,
                eventMapper
        ));
    }

    @Override
    public Optional<Event> getEventById(int id) {
        var params = new MapSqlParameterSource();
        params.addValue("id", id);
        return jdbcTemplate.query(
                        SQL_GET_EVENT_BY_ID,
                        params,
                        eventMapper
                ).stream()
                .findFirst();
    }

    @Override
    public void insertEvent(EventRequest eventForm) {
        var params = new MapSqlParameterSource();
        params.addValue("news_header", eventForm.news_header());
        params.addValue("news_preview", eventForm.news_preview());
        params.addValue("news_text", eventForm.news_text());
        params.addValue("url", eventForm.url());
        jdbcTemplate.update(SQL_INSERT_EVENT, params);
    }
}
