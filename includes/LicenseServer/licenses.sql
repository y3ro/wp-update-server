CREATE TABLE license (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  license_key TEXT NOT NULL,
  product_slug TEXT NOT NULL,
  user_email TEXT NOT NULL,
  license_capacity INTEGER NOT NULL,
  license_status TEXT CHECK(license_status IN ('active', 'cancelled')) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_license_key ON license (license_key);

CREATE TABLE license_register (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  license_id INTEGER NOT NULL,
  domain TEXT NOT NULL,
  registered_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (license_id) REFERENCES license(id),
  UNIQUE(license_id, domain)
);

CREATE INDEX idx_license_id ON license_register (license_id);

-- TODO: registration (register/unregister) history