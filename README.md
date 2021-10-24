Wovie: Redux

I've changed the formatting for version:

0.0.0 (Major reworks . New features . bug fixes)

Features to be added:
- TMDB
  - Request for MPAA ratings to be added
    - I am having no luck with this and searching online isn't helping either, seems to be a common issue with tmdb

Patch notes for 3.2.0 (completed features only):

- Report function been built on
  - Reported now show on user profile (only for logged in user) this will help users check up on their reports
  - Reports on users profile now have eye symbol to view content directly
  - Viewing reports via the admin panel will have an eye symbol to view content
  - Viewing reports via the admin panel will show username if signed in or email if user submitted one

- Collections system been built on
  - Collections now can be selected as a 'Playlist' which will show on the playlists page https://example.com/playlists
  - Collections can now be selected as a 'service' which will show on the services page https://example.com/services
  - Collections can be set as a 'Featured Playlist' or 'Featured Service' which will appear in their own section on the home page

- Homepage additional modules
  - Added 'Featured Playlists'
  - Added 'Featured Services'

- Profile fields
  - Added Report Tickets to the profile page, this is only visible to the user to view report status
