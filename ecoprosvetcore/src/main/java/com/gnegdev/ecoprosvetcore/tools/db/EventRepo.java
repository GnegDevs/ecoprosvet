package com.gnegdev.ecoprosvetcore.tools.db;

import java.util.List;
import java.util.Optional;

public interface EventRepo {
    Optional<List<Event>> getEvents();
    Optional<Event> getEventById(int id);
    void insertEvent(EventRequest eventForm);
}
