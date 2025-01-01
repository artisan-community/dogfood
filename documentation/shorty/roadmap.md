# Roadmap

Here are some things that we are not addressing right now, but are on our radar for the future.

## Known Limitations

### No Way to Use Short Codes in Pre or Code Blocks

Short codes within `code` and `pre` blocks, whether in HTML or Markdown, will be ignored. This is to satisfy our primary use case, which is to use short codes in our markdown documentation (like the documentation for this package). While we do not foresee a need ourselves to allow for "live" content within `pre` or `code` blocks, we can think of a few use cases for it. So we're thinking through ways to enable short codes within these blocks on an individual opt-in basis.