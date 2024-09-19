package com.gnegdev.ecoprosvetcore.tools.db;

import org.springframework.jdbc.core.RowMapper;

import java.sql.ResultSet;
import java.sql.SQLException;
import org.springframework.stereotype.Component;

@Component
public class EventMapper implements RowMapper<Event> {

    @Override
    public Event mapRow(ResultSet rs, int rowNum) throws SQLException {
        return new Event(
                rs.getInt("id"),
                rs.getString("news_header"),
                rs.getString("news_preview"),
                rs.getString("news_text"),
                rs.getString("url")
        );
    }
}
